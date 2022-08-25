<?php

namespace Latvel\FilamentTemplate;

use Filament\PluginServiceProvider;
use Latvel\FilamentTemplate\Commands\CreateTemplateCommand;
use Spatie\LaravelPackageTools\Package;

class FilamentTemplateServiceProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-template')
            ->hasViews()
            ->hasCommand(CreateTemplateCommand::class);
    }
}
