<?php

namespace Softce\Hotline;

use Illuminate\Support\ServiceProvider;

class HotlineServiceProvider extends ServiceProvider
{

    public function boot(){
        $this->loadRoutesFrom(dirname(__DIR__).'\Http\routes.php');
        $this->loadViewsFrom(dirname(__DIR__).'\views', 'hotline');
    }

    public function register(){
        $this->app->bind('Softce\Hotline', function(){
            return new Hotline;
        });
    }

}