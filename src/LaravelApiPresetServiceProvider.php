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
            $command->warn('This command will remove all frontend files (i.e. package.json, JavaScript, SASS, views, etc.)');

            if (! $command->confirm('Are you sure you want to install this preset?')) {
                $command->info('Command aborted successfully');

                return;
            }

            LaravelApiPreset::install();

            $command->info('Frontend scaffolding removed successfully');
        });
    }
}
