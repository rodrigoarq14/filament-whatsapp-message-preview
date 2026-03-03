# WhatsApp Message Preview

![Header](https://raw.githubusercontent.com/rodrigoarq14/filament-whatsapp-message-preview/main/.github/images/cover.webp)

[![Latest Version](https://img.shields.io/packagist/v/rarq/filament-whatsapp-message-preview?style=for-the-badge)](https://packagist.org/packages/rarq/filament-whatsapp-message-preview)
[![Downloads](https://img.shields.io/packagist/dt/rarq/filament-whatsapp-message-preview?style=for-the-badge)](https://packagist.org/packages/rarq/filament-whatsapp-message-preview)
[![PHP Version](https://img.shields.io/packagist/php-v/rarq/filament-whatsapp-message-preview?style=for-the-badge)](https://packagist.org/packages/rarq/filament-whatsapp-message-preview)
[![Laravel](https://img.shields.io/badge/Laravel-10%20%7C%2011%20%7C%2012-FF2D20?style=for-the-badge&logo=laravel)](https://github.com/laravel/laravel)
[![Filament](https://img.shields.io/badge/Filament-3%20%7C%204%20%7C%205-F59E0B?style=for-the-badge)](https://github.com/filamentphp/filament)
[![License](https://img.shields.io/packagist/l/rarq/filament-whatsapp-message-preview?style=for-the-badge)](https://packagist.org/packages/rarq/filament-whatsapp-message-preview)

A FilamentPHP field plugin that renders a real-time WhatsApp-style message preview with support for formatting, lists, quotes and message direction.

## Preview

![Screenshot 1](https://raw.githubusercontent.com/rodrigoarq14/filament-whatsapp-message-preview/main/.github/images/screenshot-1.webp)
<br>
![Screenshot 2](https://raw.githubusercontent.com/rodrigoarq14/filament-whatsapp-message-preview/main/.github/images/screenshot-2.webp)

## Features

- 📱 Real-time WhatsApp-style preview
- ↔️ Incoming & outgoing message direction
- ✏️ Supports formatting (bold, italic, lists, quotes)
- 🧩 Seamless integration with Filament Forms
- 🎨 Tailwind-powered styling

## Compatibility

| Filament Version | Laravel Version | PHP Version | Tailwind Version |
|------------------|-----------------|------------|------------------|
| v3.x             | Laravel 10      | 8.1 – 8.3  | Tailwind CSS v3  |
| v4.x             | Laravel 11      | 8.2 – 8.4  | Tailwind CSS v4  |
| v5.x             | Laravel 11–12   | 8.2 – 8.5  | Tailwind CSS v4  |

> PHP compatibility is determined by the supported Laravel version.

## Installation

You can install the package via composer:

```bash
composer require rarq/filament-whatsapp-message-preview
```

## Assets

This package includes Blade views that must be scanned by Tailwind CSS to properly generate the component styles.

The configuration differs depending on your Filament version.

---

### FilamentPHP v3

If you are using **Filament v3**, you must create a custom theme and register the package views inside your `tailwind.config.js`.

📖 <a href="https://filamentphp.com/docs/3.x/panels/themes#creating-a-custom-theme" target="_blank">Click here</a> to follow the official guide for creating a custom theme.

Then, add the plugin views to the `content` array of your `tailwind.config.js`:

```js
content: [
    // ...
    './vendor/rarq/filament-whatsapp-message-preview/resources/views/**/*.blade.php',
]
```

After that, rebuild your assets:

```bash
npm run build
```

---

### FilamentPHP v4 & v5

If you are using **Filament v4 or v5**, you must also create a custom theme.

📖 Official documentation:

- Filament v4: <a href="https://filamentphp.com/docs/4.x/styling/overview#creating-a-custom-theme" target="_blank">Click here</a>  
- Filament v5: <a href="https://filamentphp.com/docs/5.x/styling/overview#creating-a-custom-theme" target="_blank">Click here</a>  

Instead of modifying your `tailwind.config.js`, register the package views using the `@source` directive inside your custom theme CSS file (usually located at `resources/css/filament/admin/theme.css`):

```css
@source '../../../../vendor/rarq/filament-whatsapp-message-preview/resources/views';
```

Then rebuild your assets:

```bash
npm run build
```

---

⚠️ **Important:**  
If you do not configure these assets correctly, Tailwind may purge the component styles and the WhatsApp preview UI may not render properly.

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

## Available Methods

| Method | Description |
|--------|-------------|
| `hideMessageDirectionTabs()` | Hide the direction selector tabs |
| `messageDirection()` | Set default message direction |
| `incomingDirectionLabel()` | Customize incoming label |
| `outgoingDirectionLabel()` | Customize outgoing label |
| `previewLabel()` | Customize preview title |
| `hiddenPreview()` | Hide the preview panel |

## Troubleshooting

### Styles not applied?

Make sure:

- You created a custom Filament theme
- You registered the package views in Tailwind
- You rebuilt your assets (`npm run build`)

## Contributing

Contributions are welcome!

Please open an issue before submitting a pull request.

## Credits

- [Rodrigo A. Ríos Q.](https://github.com/rodrigoarq14)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.