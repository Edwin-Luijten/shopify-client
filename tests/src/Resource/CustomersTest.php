<?php

namespace ShopifyClient\Tests\Resource;

class CustomersTest extends SimpleResource
{
    /**
     * @var array
     */
    private $postAddressArray = [];

    /**
     * @var array
     */
    private $putAddressArray = [];

    public function setUp()
    {
        parent::setUp();

        $this->postArray = [
            'email'      => 'foo@bar.com',
            'first_name' => 'Foo',
            'last_name'  => 'Bar',
        ];

        $this->putArray = [
            'first_name' => 'Bar',
            'last_name'  => 'Foo',
        ];

        $this->postAddressArray = [
            'address1'      => '1 Rue des Carrieres',
            'address2' => 'Suite 1234',
            'city'  => 'Montreal',
            'company' => 'Fancy Co.',
            'first_name' => 'Samuel',
            'last_name' => 'de Champlain',
            'phone' => '819-555-5555',
            'province' => 'Quebec',
            'country' => 'Canada',
            'zip' => 'G1R 4P5',
            'name' => 'Samuel de Champlain',
            'province_code' => 'QC',
            'country_code' => 'CA',
            'country_name' => 'Canada',
        ];

        $this->putAddressArray = [
            'zip' => '90210',
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
     */
    public function testExceptionOnDuplicate()
    {
        try {
            $this->testCreate();
        } catch (\ShopifyClient\Exception\ClientException $e) {
            $this->assertNotEmpty($e->getErrors());
        }
    }

    public function testExceptionNotFound()
    {
        try {
            $this->testGet(1);
        } catch (\ShopifyClient\Exception\ClientException $e) {
            $this->assertNotEmpty($e->getErrors());
        }
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
                    'variant_id' => getenv('SHOPIFY_PRODUCT_VARIANT_ID'),
                    'quantity'   => 1,
                ],
            ],
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
     * @return array
     */
    public function testCreateAddress($id)
    {
        $item = static::$client->customers->addresses->create($id, $this->postAddressArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->postAddressArray as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }

        return [
            'customerId' => $id,
            'id'        => $item['id'],
        ];
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testAllAddresses($id)
    {
        $results = static::$client->customers->addresses->all($id);

        $this->assertNotEmpty($results);
    }

    /**
     * @depends testCreateAddress
     * @param array $ids
     * @return array
     */
    public function testGetAddress(array $ids)
    {
        $item = static::$client->customers->addresses->get($ids['customerId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetAddress
     * @param array $ids
     */
    public function testUpdateAddress(array $ids)
    {
        $item = static::$client->customers->addresses->update($ids['customerId'], $ids['id'], $this->putAddressArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putAddressArray as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @depends testGetAddress
     * @param array $ids
     * @expectedException \ShopifyClient\Exception\ClientException
     */
    public function testDeleteAddress(array $ids)
    {
        // Trying to remove a customers default address results in a failure
        static::$client->customers->addresses->delete($ids['customerId'], $ids['id']);

        $this->assertTrue(true);
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
