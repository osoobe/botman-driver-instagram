<?php

namespace BotMan\Drivers\Instagram\Providers;

use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Instagram\Commands\AddGreetingText;
use BotMan\Drivers\Instagram\Commands\AddPersistentMenu;
use BotMan\Drivers\Instagram\Commands\AddStartButtonPayload;
use BotMan\Drivers\Instagram\Commands\Nlp;
use BotMan\Drivers\Instagram\Commands\WhitelistDomains;
use BotMan\Drivers\Instagram\InstagramAudioDriver;
use BotMan\Drivers\Instagram\InstagramDriver;
use BotMan\Drivers\Instagram\InstagramFileDriver;
use BotMan\Drivers\Instagram\InstagramImageDriver;
use BotMan\Drivers\Instagram\InstagramLocationDriver;
use BotMan\Drivers\Instagram\InstagramVideoDriver;
use BotMan\Studio\Providers\StudioServiceProvider;
use Illuminate\Support\ServiceProvider;

class InstagramServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->isRunningInBotManStudio()) {
            $this->loadDrivers();

            $this->publishes([
                __DIR__.'/../../stubs/instagram.php' => config_path('botman/instagram.php'),
            ]);

            $this->mergeConfigFrom(__DIR__.'/../../stubs/instagram.php', 'botman.instagram');

            if ($this->app->runningInConsole()) {
                $this->commands([
                    Nlp::class,
                    AddGreetingText::class,
                    AddPersistentMenu::class,
                    AddStartButtonPayload::class,
                    WhitelistDomains::class,
                ]);
            }
        }
    }

    /**
     * Load BotMan drivers.
     */
    protected function loadDrivers()
    {
        DriverManager::loadDriver(InstagramDriver::class);
        DriverManager::loadDriver(InstagramAudioDriver::class);
        DriverManager::loadDriver(InstagramFileDriver::class);
        DriverManager::loadDriver(InstagramImageDriver::class);
        DriverManager::loadDriver(InstagramLocationDriver::class);
        DriverManager::loadDriver(InstagramVideoDriver::class);
    }

    /**
     * @return bool
     */
    protected function isRunningInBotManStudio()
    {
        return class_exists(StudioServiceProvider::class);
    }
}
