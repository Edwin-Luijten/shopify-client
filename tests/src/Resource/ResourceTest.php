<?php

namespace ShopifyClient\Tests\Resource;

use ShopifyClient\Tests\BaseTest;

class ResourceTest extends BaseTest
{
    public function testRateLimit()
    {
        $products = [];

        for ($i = 0; $i < getenv('SHOPIFY_RATE_LIMIT'); $i++) {
            $products = array_merge($products, static::$client->products->all([
                'limit' => 1,
            ]));
        }

        $this->assertNotEmpty($products);
        $this->assertGreaterThan(0, static::$client->products->getRequest()->getRateLimitReached());
    }

    /**
     * @expectedException \ShopifyClient\Exception\ClientException
     */
    public function testInvalidAction() {
        static::$client->products->dump();
    }
}