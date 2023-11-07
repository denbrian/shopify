<?php

namespace Denbrian\Shopify\Test;

use Denbrian\Shopify\Helpers\Testing\ModelFactory\ProductFactory;
use Denbrian\Shopify\Helpers\Testing\TransactionMock;
use Denbrian\Shopify\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductsApiTest extends TestCase
{
    /**
     * GET /admin/products.json
     * Retrieves a list of products.
     *
     * @test
     *
     * @throws \Denbrian\Shopify\Exceptions\InvalidOrMissingEndpointException
     * @throws \ReflectionException
     */
    public function it_gets_a_list_of_products()
    {
        $api = \Denbrian\Shopify\Shopify::fake([
            TransactionMock::create(ProductFactory::create(2)),
        ]);

        $response = $api->products->get();

        $this->assertEquals(200, $api->lastResponseStatusCode());
        $this->assertTrue(is_array($response));
        $this->assertEquals('GET', $api->lastRequestMethod());
        $this->assertEquals('/admin/products.json', $api->lastRequestUri());
        $this->assertCount(2, $response);
    }

    /**
     * GET /admin/products/count.json
     * Retrieve a count of all products.
     *
     * @test
     *
     * @throws \Denbrian\Shopify\Exceptions\InvalidOrMissingEndpointException
     * @throws \ReflectionException
     */
    public function it_gets_a_count_of_products()
    {
        $api = \Denbrian\Shopify\Shopify::fake([
            TransactionMock::create('{ "count": 2 }'),
        ]);

        $response = $api->products->count();

        $this->assertEquals(200, $api->lastResponseStatusCode());
        $this->assertEquals('GET', $api->lastRequestMethod());
        $this->assertEquals('/admin/products/count.json', $api->lastRequestUri());
        $this->assertEquals(2, $response);
    }

    /**
     * GET /admin/products/123.json
     * Retrieves a single product.
     *
     * @test
     *
     * @throws \Denbrian\Shopify\Exceptions\InvalidOrMissingEndpointException
     * @throws \Denbrian\Shopify\Exceptions\ModelNotFoundException
     * @throws \ReflectionException
     */
    public function it_gets_a_product()
    {
        $api = \Denbrian\Shopify\Shopify::fake([
            TransactionMock::create(ProductFactory::create()),
        ]);

        $response = $api->products->find($product_id = 123);

        $this->assertEquals(200, $api->lastResponseStatusCode());
        $this->assertEquals(Product::class, get_class($response));
        $this->assertEquals('GET', $api->lastRequestMethod());
        $this->assertEquals('/admin/products/123.json', $api->lastRequestUri());
    }

    /**
     * POST /admin/products.json
     * Creates a new product.
     *
     * @test
     *
     * @throws \Denbrian\Shopify\Exceptions\InvalidOrMissingEndpointException
     * @throws \ReflectionException
     */
    public function it_creates_a_new_product()
    {
        $api = \Denbrian\Shopify\Shopify::fake([
            TransactionMock::create(ProductFactory::create(), 201),
        ]);

        $response = $api->products->post(json_decode('{
            "title": "Burton Custom Freestyle 151",
            "body_html": "<strong>Good snowboard!</strong>",
            "vendor": "Burton",
            "product_type": "Snowboard",
            "tags": "Barnes & Noble, John\'s Fav, &quot;Big Air&quot;"
          }', true));

        $this->assertEquals(201, $api->lastResponseStatusCode());
        $this->assertTrue(is_array($response));
        $this->assertEquals('POST', $api->lastRequestMethod());
        $this->assertEquals('/admin/products.json', $api->lastRequestUri());
    }

    /**
     * PUT /admin/products/123.json
     * Updates a product and its variants and images.
     *
     * @test
     *
     * @throws \Denbrian\Shopify\Exceptions\InvalidOrMissingEndpointException
     * @throws \ReflectionException
     */
    public function it_updates_a_product()
    {
        $update = [
            'title' => 'New product title',
        ];

        $api = \Denbrian\Shopify\Shopify::fake([
            TransactionMock::create(ProductFactory::create(1, $update)),
        ]);

        $response = $api->products(123)->put($update);

        $this->assertEquals(200, $api->lastResponseStatusCode());
        $this->assertEquals('PUT', $api->lastRequestMethod());
        $this->assertEquals('/admin/products/123.json', $api->lastRequestUri());
        $this->assertTrue(is_array($response));
        $this->assertEquals($update['title'], $response['title']);
    }

    /**
     * DELETE /admin/products/123.json
     * Delete a product along with all its variants and images.
     *
     * @test
     *
     * @throws \ReflectionException
     */
    public function it_deletes_a_product()
    {
        $api = \Denbrian\Shopify\Shopify::fake([
            TransactionMock::create(),
        ]);

        $response = $api->products(123)->delete();

        $this->assertEquals(200, $api->lastResponseStatusCode());
        $this->assertEquals('DELETE', $api->lastRequestMethod());
        $this->assertEquals('/admin/products/123.json', $api->lastRequestUri());
        $this->assertTrue(empty($response));
    }
}
