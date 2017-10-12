<?php

namespace ShopifyClient\Tests\Resource;

use ShopifyClient\Exception\ShopifyException;
use ShopifyClient\Tests\BaseTest;

class UsersTest extends BaseTest
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testAll()
    {
        try {
            $results = static::$client->users->all();

            $this->assertNotEmpty($results);

            return $results[0]['id'];
        } catch (ShopifyException $e) {
            if ($e->getCode() === 404) {
                $this->markTestSkipped('Users resource only available for Shopify+.');
            }
        }
    }

    /**
     * @depends testAll
     * @param $id
     */
    public function testGet($id = null)
    {
        if (empty($id)) {
            $this->markTestSkipped('Users resource only available for Shopify+.');
        } else {
            $item = static::$client->users->get($id);

            $this->assertSame($item['id'], $id);
        }
    }
}