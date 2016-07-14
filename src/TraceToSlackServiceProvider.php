<?php namespace Lfelin\TraceToSlack;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class TraceToSlackServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(){
        $this->package("lfelin/laravel-tracetoslack");
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Config
        $this->app['config']->package('lfelin/laravel-tracetoslack', __DIR__.'/config', 'tracetoslack');

        // Register
        $this->app['TraceToSlack'] = $this->app->share(
            function($app)
            {
                return new TraceToSlack();
            }
        );

        // Register helper Curl
        $this->app->register('Ixudra\Curl\CurlServiceProvider');

        // Alias
        AliasLoader::getInstance()->alias('TraceToSlack', 'Lfelin\TraceToSlack\Facades\TraceToSlack');
        AliasLoader::getInstance()->alias('Curl', 'Ixudra\Curl\Facades\Curl');
    }

    /**
     * @return array
     */
    public function provides()
    {
        return array('TraceToSlack');
    }
}
