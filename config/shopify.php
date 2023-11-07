<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Base
    |--------------------------------------------------------------------------
    |
    | Configure API version in which you wish to use in your app(s).
    | e.g. admin, admin/api/2020-07, ...
    |
    | @see https://help.shopify.com/en/api/versioning
    */

    'api_base'    => env('SHOPIFY_API_BASE', 'admin/api/2020-07'),

    /*
    |--------------------------------------------------------------------------
    | Shopify Shop
    |--------------------------------------------------------------------------
    |
    | If your app is managing a single shop, you should configure it here.
    |
    | e.g. my-cool-store.myshopify.com
    */

    'shop'    => env('SHOPIFY_DOMAIN', ''),

    /*
    |--------------------------------------------------------------------------
    | Shopify Token
    |--------------------------------------------------------------------------
    |
    | Use of a token implies you've already proceeding to Shopify's Oauth flow
    | and have a token in your possession to make subsequent requests. See the
    | readme.md for help getting your token.
    */

    'token' => env('SHOPIFY_TOKEN', ''),

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | log_api_request_data:
    | When enabled will log the data of every API Request to shopify
    */

    'options' => [
        'log_api_request_data' => env('SHOPIFY_OPTION_LOG_API_REQUEST', 0),
        'log_deprecation_warnings' => env('SHOPIFY_OPTIONS_LOG_DEPRECATION_WARNINGS', 1),
    ],

    'webhooks' => [
        /**
         * Do not forget to add 'webhook/*' to your VerifyCsrfToken middleware.
         */
        'enabled'       => env('SHOPIFY_WEBHOOKS_ENABLED', 1),
        'route_prefix'  => env('SHOPIFY_WEBHOOKS_ROUTE_PREFIX', 'webhook/shopify'),
        'secret'        => env('SHOPIFY_WEBHOOKS_SECRET'),
        'middleware'    => Denbrian\Shopify\Integrations\Laravel\Http\WebhookMiddleware::class,
        'event_routing' => [
            'carts/create'               => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'carts/update'               => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'checkouts/create'           => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'checkouts/delete'           => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'checkouts/update'           => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'collection_listings/add'    => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'collection_listings/remove' => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'collection_listings/update' => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'collections/create'         => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'collections/delete'         => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'collections/update'         => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'customer_groups/create'     => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'customer_groups/delete'     => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'customer_groups/update'     => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'customers/create'           => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'customers/delete'           => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'customers/disable'          => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'customers/enable'           => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'customers/update'           => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'disputes/create'            => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'disputes/update'            => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'draft_orders/create'        => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'draft_orders/delete'        => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'draft_orders/update'        => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'fulfillment_events/create'  => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'fulfillment_events/delete'  => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'fulfillments/create'        => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'fulfillments/update'        => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'order_transactions/create'  => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'orders/cancelled'           => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'orders/create'              => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'orders/delete'              => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'orders/fulfilled'           => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'orders/paid'                => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'orders/partially_fulfilled' => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'orders/updated'             => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'product_listings/add'       => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'product_listings/remove'    => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'product_listings/update'    => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'products/create'            => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'products/delete'            => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'products/update'            => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'refunds/create'             => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'shop/update'                => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'app/uninstalled'            => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'themes/create'              => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'themes/delete'              => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'themes/publish'             => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
            'themes/update'              => Denbrian\Shopify\Integrations\Laravel\Events\WebhookEvent::class,
        ],
    ],
];
