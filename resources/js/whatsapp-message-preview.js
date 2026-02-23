function fwapFormatComponent(statePath, wire, initialDirection) {
    return {
        state: wire.$entangle(statePath),
        direction: initialDirection ?? 'incoming',
        escapeHtml(t) {
            return t
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        },
        applyStyles(t) {
            return (!t) ? '' :
                t.replace(/\*(?!\s)([^*\n]+?)(?<!\s)\*/g, '<strong>$1</strong>')
                 .replace(/_(?!\s)([^_\n]+?)(?<!\s)_/g, '<em>$1</em>')
                 .replace(/~(?!\s)([^~\n]+?)(?<!\s)~/g, '<del>$1</del>');
        },
        formatWhatsApp(i) {
            if (!i) return '...';

            let codeBlocks = [];
            let inlineCodes = [];
            let lines = i.split('\n');
            let result = '';
            let currentList = null;

            const processSegments = (text) => {
                let remaining = text;

                // 1. Extraer ```code``` siempre como pre
                remaining = remaining.replace(/```([^`]*)```/g, (_, code) => {
                    let idx = codeBlocks.length;
                    codeBlocks.push(code);
                    return `|||BLOCK${idx}|||`;
                });

                // 2. Extraer `code`
                remaining = remaining.replace(/(?<!`)`(?!`)([^`\n]+)`(?!`)/g, (_, code) => {
                    let idx = inlineCodes.length;
                    inlineCodes.push(code);
                    return `|||INLINE${idx}|||`;
                });

                // 3. Escapar HTML
                remaining = this.escapeHtml(remaining);

                // 4. Aplicar estilos
                remaining = this.applyStyles(remaining);

                // 5. Restaurar bloques siempre como <pre>
                remaining = remaining.replace(/\|\|\|BLOCK(\d+)\|\|\|/g, (_, idx) => {
                    return `<pre>${this.escapeHtml(codeBlocks[parseInt(idx)])}</pre>`;
                });

                // 6. Restaurar inline como <code>
                remaining = remaining.replace(/\|\|\|INLINE(\d+)\|\|\|/g, (_, idx) => {
                    return `<code>${this.escapeHtml(inlineCodes[parseInt(idx)])}</code>`;
                });

                return remaining;
            };

            lines.forEach((line, index) => {
                if (/^> /.test(line)) {
                    if (currentList) { result += '</ul>'; currentList = null; }
                    result += `<blockquote>${processSegments(line.replace(/^> /, ''))}</blockquote>`;
                } else if (/^- /.test(line)) {
                    if (currentList !== 'ul') { if (currentList) result += '</ul>'; result += '<ul>'; currentList = 'ul'; }
                    result += `<li>${processSegments(line.replace(/^- /, ''))}</li>`;
                } else if (/^\d+\. /.test(line)) {
                    let match = line.match(/^(\d+)\. (.*)/);
                    if (currentList !== 'ol') { if (currentList) result += '</ul>'; result += '<ul class="fwap-ol">'; currentList = 'ol'; }
                    result += `<li><span class="fwap-number">${match[1]}.</span>${processSegments(match[2])}</li>`;
                } else {
                    if (currentList) { result += '</ul>'; currentList = null; }
                    result += processSegments(line) + (index < lines.length - 1 ? '<br>' : '');
                }
            });

            if (currentList) result += '</ul>';
            return result;
        }
    }
}