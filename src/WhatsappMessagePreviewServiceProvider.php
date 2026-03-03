<?php

namespace Rarq\FilamentWhatsappMessagePreview;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Livewire\Features\SupportTesting\Testable;
use Rarq\FilamentWhatsappMessagePreview\Testing\TestsWhatsappMessagePreview;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WhatsappMessagePreviewServiceProvider extends PackageServiceProvider
{
    /**
     * @var string
     */
    public static string $name = 'filament-whatsapp-message-preview';

    /**
     * @var string
     */
    public static string $viewNamespace = 'filament-whatsapp-message-preview';

    /**
     * @param Package $package
     * 
     * @return void
     */
    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasTranslations();

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    /**
     * @return void
     */
    public function packageRegistered(): void
    {
        //
    }

    /**
     * @return void
     */
    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Testing
        Testable::mixin(new TestsWhatsappMessagePreview);
    }

    /**
     * @return string|null
     */
    protected function getAssetPackageName(): ?string
    {
        return 'rarq/filament-whatsapp-message-preview';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            Js::make('whatsapp-preview', __DIR__ . '/../resources/js/whatsapp-message-preview.js'),
            Css::make('whatsapp-preview', __DIR__ . '/../resources/css/whatsapp-message-preview.css'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }
}
