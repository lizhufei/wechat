<?php

namespace Hsvisus\Wechat;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class WechatProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * 服务提供者加是否延迟加载.
     * @var bool
     */
    protected $defer = true; // 延迟加载服务


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('wechat', function ($app) {
            return new Wechat();

        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        //路由
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        //配置文件
        $this->publishes([
            __DIR__.'/Config/wechat.php' => config_path('wechat.php'),
        ]);
        //数据迁移
        $migrations = [
            __DIR__.'/Migrations/2021_08_18_093603_create_visitors_table.php',
            __DIR__.'/Migrations/2021_08_18_093829_create_appointments_table.php',
            __DIR__.'/Migrations/2021_08_18_093919_create_visitor_infos_table.php',
            __DIR__.'/Migrations/2021_08_18_102230_create_access_codes_table.php',
            __DIR__.'/Migrations/2021_08_18_100102_create_configurations_table.php',
            __DIR__.'/Migrations/2021_08_20_150501_create_subscribers_table.php',
            __DIR__.'/Migrations/2021_08_25_143343_create_qr_table.php',
        ];
        $this->loadMigrationsFrom($migrations);
    }
    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return ['wechat'];
    }
}
