@php
    use Filament\Support\Facades\FilamentView;
    use Rarq\FilamentWhatsappMessagePreview\Enums\MessageDirection;

    $hasInlineLabel = $hasInlineLabel();
    $isConcealed = $isConcealed();
    $isDisabled = $isDisabled();
    $hiddenPreview = $isHiddenPreview();
    $rows = $getRows();
    $placeholder = $getPlaceholder();
    $previewLabel = $getPreviewLabel();
    $shouldAutosize = $shouldAutosize();
    $statePath = $getStatePath();
    $messageDirection = $getMessageDirection();
    $incomingLabel = $getIncomingDirectionLabel();
    $outgoingLabel = $getOutgoingDirectionLabel();
    $shouldHideMessageDirectionTabs = $shouldHideMessageDirectionTabs();

    $initialHeight = (($rows ?? 2) * 1.5) + 0.75;
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field">

    <x-slot name="label" @class(['sm:pt-1.5'=> $hasInlineLabel])>
        {{ $getLabel() }}
    </x-slot>

    <div x-data="fwapFormatComponent('{{ $statePath }}', $wire, '{{ $messageDirection->value }}')">
        <x-filament::input.wrapper
            :disabled="$isDisabled"
            :valid="! $errors->has($statePath)"
            :attributes="\Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())->class(['fi-fo-textarea overflow-hidden'])">
            <div wire:ignore.self style="height: '{{ $initialHeight . 'rem' }}'">
                <textarea
                    @if (FilamentView::hasSpaMode())
                    x-load="visible || event (ax-modal-opened)"
                    @else
                    x-load
                    @endif
                    x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('textarea', 'filament/forms') }}"
                    x-data="textareaFormComponent({
                        initialHeight: @js($initialHeight),
                        shouldAutosize: @js($shouldAutosize),
                        state: $wire.$entangle('{{ $statePath }}'),
                    })"
                    x-model="state"
                    @if ($shouldAutosize)
                    x-intersect.once="resize()"
                    x-on:resize.window="resize()"
                    @endif
                    {{ $getExtraInputAttributeBag()->merge([
                        'id' => $getId(),
                        'rows' => $rows,
                        'placeholder' => $placeholder,
                        'disabled' => $isDisabled,
                    ], escape: false)
                    ->class([
                        'block h-full w-full border-none bg-transparent px-3 py-1.5 text-base text-gray-950 focus:ring-0 dark:text-white sm:text-sm',
                        'resize-none' => $shouldAutosize,
                    ]) }}></textarea>
            </div>
        </x-filament::input.wrapper>

        @if (! $hiddenPreview)
            <div class="fwap-preview-container border border-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                <div class="text-xs font-bold text-gray-500 dark:text-white mb-2">{{ $previewLabel }}</div>

                <div
                    class="fwap-bubble"
                    :class="direction === 'outgoing' ? 'fwap-outgoing' : ''"
                    x-html="formatWhatsApp(state)">
                </div>

                @if (! $shouldHideMessageDirectionTabs)
                    <div class="fwap-tabs">
                        <button
                            type="button"
                            class="fwap-tab"
                            :class="direction === 'incoming' ? 'active' : ''"
                            @click="direction = 'incoming'">
                            <x-heroicon-o-arrow-down-left class="w-3 h-3" />
                            {{ $incomingLabel }}
                        </button>
                        <button
                            type="button"
                            class="fwap-tab"
                            :class="direction === 'outgoing' ? 'active' : ''"
                            @click="direction = 'outgoing'">
                            <x-heroicon-o-arrow-up-right class="w-3 h-3" />
                            {{ $outgoingLabel }}
                        </button>
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-dynamic-component>