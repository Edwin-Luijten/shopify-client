<?php

namespace ShopifyClient\Tests\Resource;

class OrdersTest extends SimpleResource
{
    public $putArray = [
        'note' => 'Burton Custom Freestyle 500',
    ];

    public function __construct()
    {
        parent::__construct();

        $this->postArray = [
            'line_items' => [
                [
                    'variant_id' => getenv('SHOPIFY_ORDER_VARIANT_ID'),
                    'quantity'   => 1,
                ],
            ]
        ];
    }

    public function testAll()
    {
        parent::testAll();
    }

    public function testCreate()
    {
        return parent::testCreate();
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
     */
    public function testClose($id)
    {
        $item = static::$client->orders->close($id);

        $this->assertSame($item['id'], $id);
        $this->assertNotEmpty($item['closed_at']);
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testOpen($id)
    {
        $item = static::$client->orders->open($id);

        $this->assertSame($item['id'], $id);
        $this->assertEmpty($item['closed_at']);
        $this->assertEmpty($item['cancelled_at']);
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testCancel($id)
    {
        $item = static::$client->orders->cancel($id);

        $order = static::$client->orders->get($id);

        $this->assertSame($item['id'], $id);
        $this->assertNotEmpty($order['cancelled_at']);
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
