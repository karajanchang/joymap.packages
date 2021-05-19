<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2019-03-02
 * Time: 05:36
 */

namespace Joymap;

use Illuminate\Support\ServiceProvider;


class JoymapServiceProvider extends ServiceProvider
{
    protected $commands = [
    ];

    public function register(){
        $this->loadFunctions();

        /*
        $this->app->bind('Bank', function()
        {
            return app()->make(\Twdd\Helpers\Bank::class);
        });
        */

        $this->registerAliases();
    }

    public function boot(){
        if ($this->isLumen()) {
            require_once 'Lumen.php';
        }

        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }

        $this->loadTranslationsFrom(__DIR__ . '/lang', 'joymap');

        /*
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views'),
        ]);*/
    }

    protected function loadFunctions(){
        foreach (glob(__DIR__.'/functions/*.php') as $filename) {
            require_once $filename;
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            JoymapServiceProvider::class,
        ];
    }

    /**
     * Register aliases.
     *
     * @return null
     */
    protected function registerAliases()
    {
        if (class_exists('Illuminate\Foundation\AliasLoader')) {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();

//            $loader->alias('Bank', \Twdd\Facades\Bank::class);
        }
    }

    protected function isLumen()
    {
        return str_contains($this->app->version(), 'Lumen');
    }
}
