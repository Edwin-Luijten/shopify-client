<?php

namespace ShopifyClient\Tests\Resource;

class CustomersTest extends SimpleResource
{
    /**
     * @var array
     */
    private $postCustomerMetafield = [];

    /**
     * @var array
     */
    private $putCustomerMetafield = [];

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
            'email'      => sprintf('foo+%s@bar.com', mt_rand(0, 100) . microtime(true)),
            'first_name' => 'Foo',
            'last_name'  => 'Bar',
        ];

        $this->putArray = [
            'first_name' => 'Bar',
            'last_name'  => 'Foo',
        ];

        $this->postCustomerMetafield = [
            'namespace'  => 'customer',
            'key'        => 'customer',
            'value'      => 25,
            'value_type' => 'integer',
        ];

        $this->putCustomerMetafield = [
            'value' => 30,
        ];

        $this->postAddressArray = [
            [
                'address1'      => '1 Rue des Carrieres',
                'address2'      => 'Suite 1234',
                'city'          => 'Montreal',
                'company'       => 'Fancy Co.',
                'first_name'    => 'Samuel',
                'last_name'     => 'de Champlain',
                'phone'         => '819-555-5555',
                'province'      => 'Quebec',
                'country'       => 'Canada',
                'zip'           => 'G1R 4P5',
                'name'          => 'Samuel de Champlain',
                'province_code' => 'QC',
                'country_code'  => 'CA',
                'country_name'  => 'Canada',
            ],
            [
                'address1'      => '1 Rue des Carrieres',
                'address2'      => 'Suite 5000',
                'city'          => 'Montreal',
                'company'       => 'Fancy Co.',
                'first_name'    => 'Samuel',
                'last_name'     => 'de Champlain',
                'phone'         => '819-555-5555',
                'province'      => 'Quebec',
                'country'       => 'Canada',
                'zip'           => 'G1R 4P5',
                'name'          => 'Samuel de Champlain',
                'province_code' => 'QC',
                'country_code'  => 'CA',
                'country_name'  => 'Canada',
            ],
        ];

        $this->putAddressArray = [
            'zip' => '90210',
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
     * @expectedException \ShopifyClient\Exception\ShopifyException
     */
    public function testInvalidField()
    {
        $this->postArray = array_merge($this->postArray, [
            'email' => 'invalid',
        ]);

        parent::testCreate();
    }

    public function testNotFound()
    {
        try {
            $this->testGet(1);
        } catch (\ShopifyClient\Exception\ShopifyException $e) {
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
    public function testSearch($id)
    {
        $customer = static::$client->customers->get($id);
        $customers = static::$client->customers->search([
            'query' => 'email:' . $customer['email'],
        ]);

        $this->assertTrue(is_array($customers));
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testOrders($id)
    {
        $customer = static::$client->customers->get($id);
        $order = static::$client->orders->create([
            'email'      => $customer['email'],
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
            static::$client->orders->delete($ord['id']);
        }
    }

    /**
     * @depends testCreate
     * @param $id
     * @return array
     */
    public function testCreateMetafield($id)
    {
        $item = static::$client->customers->metafields->create($id, $this->postCustomerMetafield);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return [
            'customerId' => $id,
            'id'        => $item['id'],
        ];
    }

    /**
     * @depends testCreateMetafield
     * @param array $ids
     */
    public function testAllMetafields(array $ids)
    {
        $results = static::$client->customers->metafields->all($ids['customerId']);

        $this->assertNotEmpty($results);
    }

    /**
     * @depends testCreateMetafield
     * @param array $ids
     * @return array
     */
    public function testGetMetafield(array $ids)
    {
        $item = static::$client->customers->metafields->get($ids['customerId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetMetafield
     * @param array $ids
     */
    public function testUpdateMetafield(array $ids)
    {
        $item = static::$client->customers->metafields->update($ids['customerId'], $ids['id'], $this->putCustomerMetafield);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putCustomerMetafield as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @depends testGet
     * @param $id
     * @return array
     */
    public function testCreateAddress($id)
    {
        $item = null;

        foreach ($this->postAddressArray as $address) {
            $item = static::$client->customers->addresses->create($id, $address);
            $this->assertTrue(is_array($item));
            $this->assertNotEmpty($item);
        }

        return [
            'customerId' => $id,
            'id'         => $item['id'],
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
     * @depends testGetMetafield
     * @param array $ids
     */
    public function testDeleteMetafield(array $ids)
    {
        static::$client->customers->metafields->delete($ids['customerId'], $ids['id']);

        $this->assertTrue(true);
    }

    /**
     * @depends testGetAddress
     * @param array $ids
     */
    public function testDeleteAddress(array $ids)
    {
        static::$client->customers->addresses->delete($ids['customerId'], $ids['id']);

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
