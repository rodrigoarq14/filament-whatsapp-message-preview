# WhatsApp Message Preview

<div class="filament-hidden">
    
![Header](https://raw.githubusercontent.com/rodrigoarq14/filament-whatsapp-message-preview/main/.github/images/cover.webp)

</div>

A FilamentPHP field plugin that renders a real-time WhatsApp-style message preview with support for formatting, lists, quotes and message direction.

## Requirements

- FilamentPHP v3.x
- PHP 8.1+
- Laravel v10+
- Tailwind CSS v3.0+

## Installation

You can install the package via composer:

```bash
composer require rarq/filament-whatsapp-message-preview
```


## Usage

```php
use Rarq\FilamentWhatsappMessagePreview\Enums\MessageDirection;
use Rarq\FilamentWhatsappMessagePreview\Forms\Components\WhatsappMessagePreview;

public static function form(Form $form): Form
    {
        return $form
            ->schema([
                WhatsappMessagePreview::make('message_body')
                    ->label('Message')
                    ->required()
                    ->rows(5)
                    ->autosize()
                    ->hideMessageDirectionTabs(false)
                    ->messageDirection(MessageDirection::OUTGOING)
                    ->incomingDirectionLabel('Incoming')
                    ->outgoingDirectionLabel('Outgoing')
                    ->previewLabel('WhatsApp Preview')
                    ->hiddenPreview(false),
            ]);
    }
```

## Credits

- [Rodrigo A. Ríos Q.](https://github.com/rodrigoarq14)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.