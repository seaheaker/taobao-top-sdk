<?php

namespace Taobao\sdk;

use Illuminate\Support\ServiceProvider;

class TopClientProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //注册配置
        $filepath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'taobao_top.php');


        //检测是laravel 还是 lumen
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$filepath => config_path('taobao_top.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('taobao_top');
        }

        //将配置合并
        $this->mergeConfigFrom($filepath, 'taobao_top');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('topclient', function ($app) {

            if (!array_key_exists('app_key', $app['config']['taobao_top'])
                || !array_key_exists('app_secret', $app['config']['taobao_top'])) {
                throw new \InvalidArgumentException('The top client requires api keys.');
            }

            $config = array_only($app['config']['taobao_top'], ['app_key', 'app_secret', 'format']);

            //创建client对象
            $topClient = new \Taobao\sdk\topclient\TopClient($config['app_key'], $config['app_secret']);
            $topClient->format = $config['format'];

            return $topClient;
        });
    }
}
