<?php

namespace ShopifyClient\Tests\Resource;

use ShopifyClient\Tests\BaseTest;

class ShopTest extends BaseTest
{
    /**
     * @var array
     */
    private $postShopMetafield = [];

    /**
     * @var array
     */
    private $putShopMetafield = [];

    public function setUp() {
        parent::setUp();

        $this->postShopMetafield = [
            'namespace'  => 'shop',
            'key'        => 'foo',
            'value'      => 25,
            'value_type' => 'integer',
        ];

        $this->putShopMetafield = [
            'value' => 30,
        ];
    }

    public function testGet()
    {
        $shop = static::$client->shop->get();
        $this->assertTrue(array_key_exists('id', $shop));

        return $shop['id'];
    }

    /**
     * @depends testGet
     * @param $id
     * @return array
     */
    public function testCreateMetafield($id)
    {
        $item = static::$client->shop->metafields->create($id, $this->postShopMetafield);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return $item['id'];
    }

    /**
     * @depends testCreateMetafield
     * @param $id
     */
    public function testAllMetafields($id)
    {
        $results = static::$client->shop->metafields->all($id);

        $this->assertNotEmpty($results);
    }

    /**
     * @depends testCreateMetafield
     * @param $id
     * @return array
     */
    public function testGetMetafield($id)
    {
        $item = static::$client->shop->metafields->get($id);

        $this->assertSame($item['id'], $id);

        return $item['id'];
    }

    /**
     * @depends testGetMetafield
     * @param $id
     */
    public function testUpdateMetafield($id)
    {
        $item = static::$client->shop->metafields->update($id, $this->putShopMetafield);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putShopMetafield as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @depends testGetMetafield
     * @param $id
     */
    public function testDeleteMetafield($id)
    {
        static::$client->shop->metafields->delete($id);

        $this->assertTrue(true);
    }
}