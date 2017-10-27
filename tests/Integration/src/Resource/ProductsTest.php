<?php

namespace ShopifyClient\Tests\Integration\Resource;

use ShopifyClient\Exception\ShopifyException;
use ShopifyClient\Request;

class ProductsTest extends SimpleResource
{
    /**
     * @var array
     */
    private $postVariantArray = [];

    /**
     * @var array
     */
    private $putVariantArray = [];

    /**
     * @var array
     */
    private $postProductMetafield = [];

    /**
     * @var array
     */
    private $putProductMetafield = [];

    /**
     * @var array
     */
    private $postVariantMetafield = [];

    /**
     * @var array
     */
    private $putVariantMetafield = [];

    /**
     * @var array
     */
    private $postImageArray = [];

    public function setUp()
    {
        parent::setUp();

        $this->postArray = [
            'title'        => 'Burton Custom Freestyle 151',
            'body_html'    => '<strong>Good snowboard!<\/strong>',
            'vendor'       => 'Burton',
            'product_type' => 'Snowboard',
        ];

        $this->putArray = [
            'title' => 'Burton Custom Freestyle 500',
        ];

        $this->postProductMetafield = [
            'namespace'  => 'inventory',
            'key'        => 'warehouse',
            'value'      => 25,
            'value_type' => 'integer',
        ];

        $this->putProductMetafield = [
            'value' => 30,
        ];

        $this->postVariantMetafield = [
            'namespace'  => 'variant',
            'key'        => 'hello',
            'value'      => 25,
            'value_type' => 'integer',
        ];

        $this->putVariantMetafield = [
            'value' => 30,
        ];

        $this->postVariantArray = [
            'option1' => 'Yellow',
            'price'   => 1.00,
        ];

        $this->putVariantArray = [
            'option1' => 'Red',
        ];

        $this->postImageArray = [
            'src' => 'https://placehold.it/500x500',
        ];
    }

    public function testCreate()
    {
       return parent::testCreate();
    }

    public function testCreateInvalid()
    {
        try {
            static::$client->products->create([]);
        } catch (ShopifyException $e) {
            $this->assertTrue(is_array($e->getErrors()));
        }
    }

    public function testAll()
    {
        parent::testAll();
    }

    /**
     * @depends testCreate
     * @param $id
     */
    public function testGet($id)
    {
        return parent::testGet($id);
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testUpdate($id)
    {
        parent::testUpdate($id);
    }

    /**
     * @depends testCreate
     * @param $id
     * @return array
     */
    public function testCreateMetafield($id)
    {
        $item = static::$client->products->metafields->create($id, $this->postProductMetafield);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return [
            'productId' => $id,
            'id'        => $item['id'],
        ];
    }

    /**
     * @depends testCreateMetafield
     * @param array $ids
     */
    public function testAllMetafields(array $ids)
    {
        $results = static::$client->products->metafields->all($ids['productId']);

        $this->assertNotEmpty($results);

        if (static::$client->products->metafields->hasAction('count')) {
            $count = static::$client->products->metafields->count($ids['productId']);

            $items = [];
            $pages = $count <= 50 ? 1 : round($count / 50);

            for ($i = 1; $i <= $pages; $i++) {
                $items = array_merge($items, Request::throttle(function () use ($i, $ids) {
                    return static::$client->products->metafields->all($ids['productId'], [
                        'page' => $i,
                    ]);
                }));
            }

            $this->assertEquals($count, count($items));
        }
    }

    /**
     * @depends testCreateMetafield
     * @param array $ids
     * @return array
     */
    public function testGetMetafield(array $ids)
    {
        $item = static::$client->products->metafields->get($ids['productId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetMetafield
     * @param array $ids
     */
    public function testUpdateMetafield(array $ids)
    {
        $item = static::$client->products->metafields->update($ids['productId'], $ids['id'], $this->putProductMetafield);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putProductMetafield as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @depends testGet
     * @param $id
     * @return array
     */
    public function testCreateVariant($id)
    {
        $item = static::$client->products->variants->create($id, $this->postVariantArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return [
            'productId' => $id,
            'id'        => $item['id'],
        ];
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testAllVariants($id)
    {
        $results = static::$client->products->variants->all($id);

        $this->assertNotEmpty($results);

        if (static::$client->products->variants->hasAction('count')) {
            $count = static::$client->products->variants->count($id);

            $items = [];
            $pages = $count <= 50 ? 1 : round($count / 50);

            for ($i = 1; $i <= $pages; $i++) {
                $items = array_merge($items, Request::throttle(function () use ($i, $id) {
                    return static::$client->products->variants->all($id, [
                        'page' => $i,
                    ]);
                }));
            }

            $this->assertEquals($count, count($items));
        }
    }


    /**
     * @depends testCreateVariant
     * @param array $ids
     * @return array
     */
    public function testGetVariant(array $ids)
    {
        $item = static::$client->products->variants->get($ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetVariant
     * @param array $ids
     */
    public function testUpdateVariant(array $ids)
    {
        $item = static::$client->products->variants->update($ids['id'], $this->putVariantArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putVariantArray as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @depends testCreateVariant
     * @param array $ids
     * @return array
     */
    public function testCreateVariantMetafield(array $ids)
    {
        $item = static::$client->products->variants->metafields->create($ids['productId'], $ids['id'], $this->postVariantMetafield);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return [
            'productId' => $ids['productId'],
            'variantId' => $ids['id'],
            'id'        => $item['id'],
        ];
    }

    /**
     * @depends testCreateVariantMetafield
     * @param array $ids
     */
    public function testAllVariantMetafields(array $ids)
    {
        $results = static::$client->products->variants->metafields->all($ids['productId'], $ids['variantId']);

        $this->assertNotEmpty($results);

        if (static::$client->products->variants->hasAction('count')) {
            $count = static::$client->products->variants->metafields->count($ids['productId'], $ids['variantId']);

            $items = [];
            $pages = $count <= 50 ? 1 : round($count / 50);

            for ($i = 1; $i <= $pages; $i++) {
                $items = array_merge($items, Request::throttle(function () use ($i, $ids) {
                    return static::$client->products->variants->metafields->all($ids['productId'], $ids['variantId'], [
                        'page' => $i,
                    ]);
                }));
            }

            $this->assertEquals($count, count($items));
        }
    }

    /**
     * @depends testCreateVariantMetafield
     * @param array $ids
     * @return array
     */
    public function testGetVariantMetafield(array $ids)
    {
        $item = static::$client->products->variants->metafields->get($ids['productId'], $ids['variantId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetVariantMetafield
     * @param array $ids
     */
    public function testUpdateVariantMetafield(array $ids)
    {
        $item = static::$client->products->variants->metafields->update($ids['productId'], $ids['variantId'], $ids['id'], $this->putVariantMetafield);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putVariantMetafield as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @depends testGetVariant
     * @param array $ids
     * @return array
     * @internal param $id
     */
    public function testCreateImage(array $ids)
    {
        $item = static::$client->products->images->create($ids['productId'], $this->postImageArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return [
            'productId' => $ids['productId'],
            'variantId' => $ids['id'],
            'id'        => $item['id'],
        ];
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testAllImages($id)
    {
        $results = static::$client->products->images->all($id);

        $this->assertNotEmpty($results);

        if (static::$client->products->images->hasAction('count')) {
            $count = static::$client->products->images->count($id);

            $items = [];
            $pages = $count <= 50 ? 1 : round($count / 50);

            for ($i = 1; $i <= $pages; $i++) {
                $items = array_merge($items, Request::throttle(function () use ($i, $id) {
                    return static::$client->products->images->all($id, [
                        'page' => $i,
                    ]);
                }));
            }

            $this->assertEquals($count, count($items));
        }
    }

    /**
     * @depends testCreateImage
     * @param array $ids
     * @return array
     */
    public function testGetImage(array $ids)
    {
        $item = static::$client->products->images->get($ids['productId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetImage
     * @param array $ids
     */
    public function testUpdateImage(array $ids)
    {
        $item = static::$client->products->images->update($ids['productId'], $ids['id'], [
            'variant_ids' => [
                $ids['variantId'],
            ],
        ]);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        $this->assertEquals($ids['variantId'], $item['variant_ids'][0]);
    }

    /**
     * @depends testGetMetafield
     * @param array $ids
     */
    public function testDeleteMetafield(array $ids)
    {
        static::$client->products->metafields->delete($ids['productId'], $ids['id']);

        $this->assertTrue(true);
    }

    /**
     * @depends testGetImage
     * @param array $ids
     */
    public function testDeleteImage(array $ids)
    {
        static::$client->products->images->delete($ids['productId'], $ids['id']);

        $this->assertTrue(true);
    }

    /**
     * @depends testGetVariantMetafield
     * @param array $ids
     */
    public function testDeleteVariantMetafield(array $ids)
    {
        static::$client->products->variants->metafields->delete($ids['productId'], $ids['variantId'], $ids['id']);

        $this->assertTrue(true);
    }

    /**
     * @depends testGetVariant
     * @param array $ids
     */
    public function testDeleteVariant(array $ids)
    {
        static::$client->products->variants->delete($ids['productId'], $ids['id']);

        $this->assertTrue(true);
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testDelete($id)
    {
        parent::testDelete($id);
    }
}
