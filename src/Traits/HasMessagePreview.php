<?php

namespace Rarq\FilamentWhatsappMessagePreview\Traits;

use Closure;

trait HasMessagePreview
{
    protected bool | Closure $hiddenPreview = false;
    
    protected string | Closure | null $previewLabel = null;

    public function hiddenPreview(bool | Closure $condition = true): static
    {
        $this->hiddenPreview = $condition;

        return $this;
    }

    public function previewLabel(string | Closure | null $label): static
    {
        $this->previewLabel = $label;

        return $this;
    }

    public function isHiddenPreview(): bool
    {
        return (bool) $this->evaluate($this->hiddenPreview);
    }

    public function getPreviewLabel(): ?string
    {
        return $this->evaluate($this->previewLabel)
            ?? __('filament-whatsapp-message-preview::whatsapp-message-preview.preview_label');
    }
}