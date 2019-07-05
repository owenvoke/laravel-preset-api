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
        self::removeViewFiles();
        self::updateRoutes();
    }

    private static function removeJsFiles(): void
    {
        tap(new Filesystem(), function (Filesystem $filesystem): void {
            $filesystem->deleteDirectory(resource_path('js'));
            $filesystem->deleteDirectory(public_path('js'));
            $filesystem->deleteDirectory(base_path('node_modules'));

            $filesystem->delete(base_path('package.json'));
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

    private static function removeViewFiles(): void
    {
        tap(new Filesystem(), function (Filesystem $filesystem): void {
            $filesystem->delete(resource_path('views/welcome.blade.php'));

            $filesystem->put(resource_path('views/.gitkeep'), '');
        });
    }

    private static function updateRoutes(): void
    {
        tap(new Filesystem(), function (Filesystem $filesystem): void {
            $filesystem->copy(__DIR__.'/stubs/web.php.stub', base_path('routes/web.php'));
        });
    }
}
