<?php

namespace ShopifyClient\Tests\Resource;

class OrdersTest extends SimpleResource
{
    /**
     * @var array
     */
    private $postRiskArray = [];

    /**
     * @var array
     */
    private $putRiskArray = [];

    public function setUp()
    {
        parent::setUp();

        $this->postArray = [
            'line_items' => [
                [
                    'variant_id' => getenv('SHOPIFY_PRODUCT_VARIANT_ID'),
                    'quantity'   => 1,
                ],
            ],
        ];

        $this->putArray = [
            'note' => 'Burton Custom Freestyle 500',
        ];

        $this->postRiskArray = [
            'message'        => 'This order came from an anonymous proxy',
            'recommendation' => 'cancel',
            'score'          => 1.0,
            'source'         => 'External',
            'cause_cancel'   => true,
            'display'        => true,
        ];

        $this->putRiskArray = [
            'message'        => 'After further review, this is a legitimate order',
            'recommendation' => 'accept',
            'score'          => 0.0,
            'cause_cancel'   => false,
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
     * @return array
     */
    public function testCreateRisk($id)
    {
        $item = static::$client->orders->risks->create($id, $this->postRiskArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return [
            'id'      => $item['id'],
            'orderId' => $id,
        ];
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testAllRisks($id)
    {
        $results = static::$client->orders->risks->all($id);

        $this->assertNotEmpty($results);
    }

    /**
     * @depends testCreateRisk
     * @param array $ids
     * @return array
     */
    public function testGetRisk(array $ids)
    {
        $item = static::$client->orders->risks->get($ids['orderId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetRisk
     * @param array $ids
     */
    public function testUpdateRisk(array $ids)
    {
        $item = static::$client->orders->risks->update($ids['orderId'], $ids['id'], $this->putRiskArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putRiskArray as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @depends testGetRisk
     * @param array $ids
     */
    public function testDeleteRisk(array $ids)
    {
        static::$client->orders->risks->delete($ids['orderId'], $ids['id']);

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
