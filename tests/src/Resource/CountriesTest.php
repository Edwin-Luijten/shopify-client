<?php

namespace ShopifyClient\Tests\Resource;

class CountriesTest extends SimpleResource
{
    /**
     * @var array
     */
    private $putProvinceArray = [];

    public function setUp()
    {
        parent::setUp();

        $this->postArray = [
            'code' => 'US',
            'tax'  => 0.25,
        ];

        $this->putArray = [
            'tax' => 0.1,
        ];

        $this->putProvinceArray = [
            'tax' => 0.1,
        ];
    }

    public function testCreate()
    {
        return parent::testCreate();
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
     * @depends testGet
     * @param $id
     * @return array
     */
    public function testAllProvinces($id)
    {
        $results = static::$client->countries->provinces->all($id);

        $this->assertNotEmpty($results);
        $items = [];

        if (method_exists(static::$client->countries->provinces, 'count')) {
            $count = static::$client->countries->provinces->count($id);

            $pages = $count <= 50 ? 1 : round($count / 50);

            for ($i = 1; $i <= $pages; $i++) {
                $items = array_merge($items, static::$client->countries->provinces->throttle(function () use ($i, $id) {
                    return static::$client->countries->provinces->all($id, [
                        'page' => $i,
                    ]);
                }));
            }

            $this->assertEquals($count, count($items));
        }

        return [
            'countryId' => $id,
            'id'        => $items[0]['id'],
        ];
    }

    /**
     * @depends testAllProvinces
     * @param array $ids
     * @return array
     */
    public function testGetProvince(array $ids)
    {
        $item = static::$client->countries->provinces->get($ids['countryId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetProvince
     * @param array $ids
     */
    public function testUpdateProvince(array $ids)
    {
        $item = static::$client->countries->provinces->update($ids['countryId'], $ids['id'], $this->putProvinceArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putProvinceArray as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
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
