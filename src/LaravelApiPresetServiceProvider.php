<?php

declare(strict_types=1);

namespace pxgamer\LaravelApiPreset;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

final class LaravelApiPresetServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        PresetCommand::macro('api', function (Command $command): void {
            LaravelApiPreset::install();

            $command->info('Frontend scaffolding removed successfully.');
        });
    }
}
