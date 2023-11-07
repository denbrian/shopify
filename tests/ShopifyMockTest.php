<?php

namespace Denbrian\Shopify\Test;

use Denbrian\Shopify\Helpers\Testing\ShopifyMock;
use PHPUnit\Framework\TestCase;

class ShopifyMockTest extends TestCase
{
    /** @test
     * @throws \ReflectionException
     */
    public function it_gets_a_shopify_mock_class()
    {
        $mock = \Denbrian\Shopify\Shopify::fake();

        $this->assertEquals(ShopifyMock::class, get_class($mock));
    }
}
