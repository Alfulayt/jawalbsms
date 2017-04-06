<?php

namespace abdualrhmanIO\JawalbSms;

use Illuminate\Support\ServiceProvider;

class JawalbSmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/jawalbsms.php';
        $this->publishes([$configPath => config_path('jawalbsms.php')], 'config');
        $this->mergeConfigFrom($configPath, 'jawalbsms');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('jawalbsms', function ($app) {
            $config = isset($app['config']['services']['jawalbsms']) ? $app['config']['services']['jawalbsms'] : null;
            if (is_null($config)) {
                $config = $app['config']['jawalbsms'] ?: $app['config']['jawalbsms::config'];
            }

            $client = new JawalbSmsClient($config['Username'], $config['Password'], $config['SenderName']);

            return $client;
        });
    }

    public function provides() {
        return ['jawalbsms'];
    }


}
