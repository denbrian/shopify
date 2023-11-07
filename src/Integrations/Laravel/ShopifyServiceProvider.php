<?php

namespace Denbrian\Shopify\Integrations\Laravel;

use Denbrian\Shopify\Shopify;
use Denbrian\Shopify\Util;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Class ShopifyServiceProvider.
 */
class ShopifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../../config/shopify.php' => config_path('shopify.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (Util::isLaravel()) {
            $this->mergeConfigFrom(
                __DIR__ . '/../../../config/shopify.php', 'shopify'
            );
        }

        $shop = config('shopify.shop');
        $token = config('shopify.token');

        if ($shop && $token) {
            $this->app->singleton('shopify', function ($app) use ($shop, $token) {
                return new Shopify($shop, $token);
            });
        }

        if (config('shopify.webhooks.enabled')) {
            $this->registerWebhookRoutes();
        }
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerWebhookRoutes()
    {
        Route::group($this->routeWebhookConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        });
    }

    /**
     * Get the route group configuration array.
     *
     * @return array
     */
    protected function routeWebhookConfiguration()
    {
        return [
            //'domain' => config('shopify.webhooks.route_domain', config('app.url')),
            'namespace'  => 'Denbrian\Shopify\Integrations\Laravel\Http',
            'prefix'     => config('shopify.webhooks.route_prefix'),
            'middleware' => array_filter(['web', config('shopify.webhooks.middleware')]),
        ];
    }
}
