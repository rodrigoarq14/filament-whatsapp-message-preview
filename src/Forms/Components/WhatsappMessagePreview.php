<?php

namespace Rarq\FilamentWhatsappMessagePreview\Forms\Components;

use Filament\Forms\Components\Textarea;
use Rarq\FilamentWhatsappMessagePreview\Traits\HasMessageDirection;
use Rarq\FilamentWhatsappMessagePreview\Traits\HasMessagePreview;

class WhatsappMessagePreview extends Textarea
{
    use HasMessagePreview;
    use HasMessageDirection;

    /**
     * @var view-string
     */
    protected string $view = 'filament-whatsapp-message-preview::forms.components.whatsapp-message-preview';
}
