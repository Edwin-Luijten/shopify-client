<?php

namespace ShopifyClient\Tests\Resource;

use ShopifyClient\Tests\BaseTest;

abstract class SimpleResource extends BaseTest
{
    private $resource;

    /**
     * @var bool|array
     */
    protected $postArray = false;

    /**
     * @var bool|array
     */
    protected $putArray = false;

    public function setUp()
    {
        $this->resource = lcfirst(preg_replace('/.+\\\\(\w+)Test$/', '$1', get_called_class()));
    }

    public function testCreate()
    {
        if ($this->postArray) {
            $item = static::$client->{$this->resource}->create($this->postArray);

            $this->assertTrue(is_array($item));
            $this->assertNotEmpty($item);

            return $item['id'];
        }

        $this->markTestSkipped(
            sprintf('%s resource does not have this method available.', $this->resource)
        );
    }

    public function testAll()
    {
        $results = static::$client->{$this->resource}->all();

        $this->assertNotEmpty($results);

        if (method_exists(static::$client->{$this->resource}, 'count')) {
            $count = static::$client->{$this->resource}->count();

            $items = [];
            $pages = $count <= 50 ? 1 : round($count / 50);

            for ($i = 1; $i <= $pages; $i++) {
                $items = array_merge($items, static::$client->{$this->resource}->throttle(function () use ($i) {
                    return static::$client->{$this->resource}->all([
                        'page' => $i,
                    ]);
                }));
            }

            $this->assertEquals($count, count($items));
        }
    }

    /**
     * @depends testCreate
     * @param $id
     */
    public function testGet($id)
    {
        $item = static::$client->{$this->resource}->get($id);

        $this->assertSame($item['id'], $id);

        return $id;
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testUpdate($id)
    {
        if ($this->putArray) {
            $item = static::$client->{$this->resource}->update($id, $this->putArray);

            $this->assertTrue(is_array($item));
            $this->assertNotEmpty($item);

            foreach ($this->putArray as $key => $value) {
                $this->assertEquals($value, $item[$key]);
            }
        } else {
            $this->markTestSkipped(
                sprintf('%s resource does not have this method available.', $this->resource)
            );
        }
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testDelete($id)
    {
        static::$client->{$this->resource}->delete($id);

        $this->assertTrue(true);
    }
}
