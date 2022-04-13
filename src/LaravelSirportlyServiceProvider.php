<?php

namespace Pentangle\LaravelSirportly;

use Pentangle\LaravelSirportly\Commands\LaravelSirportlyCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelSirportlyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-sirportly')
            ->hasConfigFile();
//            ->hasCommands([
//                LaravelSirportlyCommand::class,
//            ]);
    }

    public function packageRegistered(): void
    {
        $this->app->singleton('sirportly', function () {
            return new LaravelSirportly(
                token: config('sirportly.token'),
                secret: config('sirportly.secret'),
            );
        });
    }
}
