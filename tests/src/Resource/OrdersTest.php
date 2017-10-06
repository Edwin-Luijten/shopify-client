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

    /**
     * @var array
     */
    private $postFulfillmentServiceArray = [];

    /**
     * @var array
     */
    private $putFulfillmentServiceArray = [];

    /**
     * @var array
     */
    private $postFulfillmentArray = [];

    /**
     * @var array
     */
    private $putFulfillmentArray = [];

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

        $this->postFulfillmentServiceArray = [
            'name'                     => 'FooFulfillment',
            'callback_url'             => 'http://google.com',
            'inventory_management'     => false,
            'tracking_support'         => false,
            'requires_shipping_method' => false,
            'format'                   => 'json',
        ];

        $this->putFulfillmentServiceArray = [
            'name' => 'FooFulfillmentService',
        ];

        $this->postFulfillmentArray = [
            'tracking_company' => 'FooFulfillmentService',
        ];

        $this->putFulfillmentArray = [
            'tracking_number' => null,
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
     * @depends testGet
     * @param $id
     * @return array
     */
    public function testCreateFulfillmentService($id)
    {
        $item = static::$client->fulfillmentServices->create($this->postFulfillmentServiceArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return [
            'id'      => $item['id'],
            'orderId' => $id,
        ];
    }

    public function testAllFulfillmentService()
    {
        $results = static::$client->fulfillmentServices->all();

        $this->assertNotEmpty($results);
    }

    /**
     * @depends testCreateFulfillmentService
     * @param array $ids
     * @return array
     */
    public function testGetFulfillmentService(array $ids)
    {
        $item = static::$client->fulfillmentServices->get($ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testCreateFulfillmentService
     * @param array $ids
     */
    public function testUpdateFulfillmentService(array $ids)
    {
        $item = static::$client->fulfillmentServices->update($ids['id'], $this->putFulfillmentServiceArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putFulfillmentServiceArray as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @depends testGet
     * @param $id
     * @return array
     */
    public function testCreateFulfillment($id)
    {
        $order = static::$client->orders->get($id);

        $lineItems = function () use ($order) {
            $lns = [];
            foreach ($order['line_items'] as $ln) {
                $lns[] = ['id' => $ln['id']];
            }

            return $lns;
        };

        $params = array_merge($this->postFulfillmentArray, ['line_items' => $lineItems()]);

        $item = static::$client->orders->fulfillments->create($id, $params);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return [
            'id'      => $item['id'],
            'fulfillmentId' => $id,
        ];
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testAllFulfillment($id)
    {
        $results = static::$client->orders->fulfillments->all($id);

        $this->assertNotEmpty($results);
    }

    /**
     * @depends testCreateFulfillment
     * @param array $ids
     * @return array
     */
    public function testGetFulfillment(array $ids)
    {
        $item = static::$client->orders->fulfillments->get($ids['fulfillmentId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetFulfillment
     * @param array $ids
     */
    public function testUpdateFulfillment(array $ids)
    {
        $item = static::$client->orders->fulfillments->update(
            $ids['fulfillmentId'],
            $ids['id'],
            $this->putFulfillmentArray
        );

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putFulfillmentArray as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @expectedException \ShopifyClient\Exception\ClientException
     * @depends testGetFulfillment
     * @param array $ids
     */
    public function testCompleteFulfillment(array $ids)
    {
        static::$client->orders->fulfillments->complete($ids['fulfillmentId'], $ids['id']);
    }

    /**
     * @depends testGetFulfillment
     * @param array $ids
     */
    public function testCancelFulfillment(array $ids)
    {
        $item = static::$client->orders->fulfillments->cancel($ids['fulfillmentId'], $ids['id']);

        $this->assertSame('cancelled', $item['status']);
    }

    /**
     * @expectedException \ShopifyClient\Exception\ClientException
     * @depends testGetFulfillment
     * @param array $ids
     */
    public function testOpenFulfillment(array $ids)
    {
        static::$client->orders->fulfillments->open($ids['fulfillmentId'], $ids['id']);
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
     * @depends testGetFulfillmentService
     * @param array $ids
     */
    public function testDeleteFulfillmentService(array $ids)
    {
        static::$client->fulfillmentServices->delete($ids['id']);

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
