<?php

declare(strict_types=1);

namespace pxgamer\LaravelApiPreset;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;

final class LaravelApiPreset extends Preset
{
    public static function install(): void
    {
        self::removeJsFiles();
        self::removeSassFiles();
    }

    private static function removeJsFiles(): void
    {
        tap(new Filesystem(), function (Filesystem $filesystem): void {
            $filesystem->deleteDirectory(resource_path('js'));
            $filesystem->deleteDirectory(public_path('js'));
            $filesystem->deleteDirectory(base_path('node_modules'));

            $filesystem->delete(base_path('webpack.mix.js'));
            $filesystem->delete(base_path('yarn.lock'));
        });
    }

    private static function removeSassFiles(): void
    {
        tap(new Filesystem(), function (Filesystem $filesystem): void {
            $filesystem->deleteDirectory(resource_path('sass'));
            $filesystem->deleteDirectory(public_path('css'));
        });
    }
}