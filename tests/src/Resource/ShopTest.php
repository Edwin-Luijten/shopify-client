<?php

namespace ShopifyClient\Tests\Resource;

use ShopifyClient\Tests\BaseTest;

class ShopTest extends BaseTest
{
    public function testGet()
    {
        $shop = static::$client->shop->get();

        $this->assertTrue(array_key_exists('id', $shop));
    }
}
