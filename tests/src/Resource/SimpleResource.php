<?php

namespace ShopifyClient\Tests\Resource;

abstract class SimpleResource extends Resource
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

    public function __construct()
    {
        $this->resource = strtolower(preg_replace('/.+\\\\(\w+)Test$/', '$1', get_called_class()));
    }

    public function testAll()
    {
        $results = static::$client->{$this->resource}->all();

        $this->assertNotEmpty($results);

        if (static::$client->{$this->resource}->isCountable()) {
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

    public function testCreate() {

        if ($this->postArray) {
            $item = static::$client->{$this->resource}->create($this->postArray);

            $this->assertTrue(is_array($item));
            $this->assertNotEmpty($item);

            return $item['id'];
        }
    }

    /**
     * @depends testCreate
     * @param $id
     */
    public function testUpdate($id) {
        if ($this->putArray) {
            $item = static::$client->{$this->resource}->update($id, $this->postArray);

            $this->assertTrue(is_array($item));
            $this->assertNotEmpty($item);

            foreach($this->putArray as $key => $value) {
                foreach ($value as $field => $val) {
                    $this->assertEquals($val, $item[$field]);
                }
            }
        }
    }
}