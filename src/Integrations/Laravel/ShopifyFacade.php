<?php

namespace Denbrian\Shopify\Integrations\Laravel;

use Illuminate\Support\Facades\Facade;

/**
 * Class ShopifyFacade.
 *
 * Facade for the Laravel Framework
 */
class ShopifyFacade extends Facade
{
    /**
     * Return \Denbrian\Shopify\Manager singleton.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shopify';
    }
}
