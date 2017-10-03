<?php

namespace ShopifyClient\Tests\Resource;

class CustomersTest extends SimpleResource
{
    public $postArray = [
        'email'      => 'foo@bar.com',
        'first_name' => 'Foo',
        'last_name'  => 'Bar',
    ];

    public $putArray = [
        'first_name' => 'Bar',
        'last_name'  => 'Foo',
    ];

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

//    /**
//     * @depends testGet
//     * @param $id
//     */
//    public function testSearch($id)
//    {
//        print_r(static::$client->customers->get($id));
//
//        $customers = static::$client->customers->search([
//            'query' => $this->postArray['email']
//        ]);
//
//        print_r($customers);
//        $this->assertSame($customers[0]['email'], $this->postArray['email']);
//    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testOrders($id)
    {
        $order = static::$client->orders->create([
            'email'      => $this->postArray['email'],
            'line_items' => [
                [
                    'variant_id' => getenv('SHOPIFY_ORDER_VARIANT_ID'),
                    'quantity'   => 1,
                ],
            ]
        ]);

        $orders = static::$client->customers->orders($id);

        $this->assertNotEmpty($orders);

        foreach ($orders as $ord) {
            $this->assertSame($order['id'], $ord['id']);
        }

        static::$client->orders->delete($order['id']);
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
    public function testDelete($id)
    {
        static::$client->customers->delete($id);

        $this->assertTrue(true);
    }
}
