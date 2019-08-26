<?php

namespace Ishushx\LaravelTranslate;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Translate::class, function(){
            return new Translate(config('services.baidu_translate.appid'),config('services.baidu_translate.key'));
        });

        $this->app->alias(Translate::class, 'translate');
    }

    public function provides()
    {
        return [Translate::class, 'translate'];
    }
}