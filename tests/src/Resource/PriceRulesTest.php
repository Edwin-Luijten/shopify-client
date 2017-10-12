<?php

namespace ShopifyClient\Tests\Resource;

class PriceRulesTest extends SimpleResource
{
    /**
     * @var array
     */
    private $postDiscountCodeArray = [];
    /**
     * @var array
     */
    private $putDiscountCodeArray = [];

    public function setUp()
    {
        parent::setUp();

        $this->postArray = [
            'title'              => 'FREESHIPPING',
            'target_type'        => 'shipping_line',
            'target_selection'   => 'all',
            'allocation_method'  => 'each',
            'value_type'         => 'percentage',
            'value'              => -100.00,
            'usage_limit'        => 20,
            'customer_selection' => 'all',
            'starts_at'          => '2017-01-19T17:59:10Z',
        ];

        $this->putArray = [
            'title' => 'FREESHIPPING WORLDWIDE',
        ];

        $this->postDiscountCodeArray = [
            'code' => 'SUMMERSALE100OFF',
        ];

        $this->putDiscountCodeArray = [
            'code' => 'WINTERSALE100OFF',
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
    public function testCreateDiscountCode($id)
    {
        $item = static::$client->priceRules->discountCodes->create($id, $this->postDiscountCodeArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return [
            'priceRuleId' => $id,
            'id'          => $item['id'],
        ];
    }

    public function testLookUpDiscountCode() {
        $item = static::$client->priceRules->discountCodes->lookup(['code' => $this->postDiscountCodeArray['code']]);

        $this->assertEmpty($item);
    }

    /**
     * @depends testCreateDiscountCode
     * @param array $ids
     */
    public function testAllDiscountCodes(array $ids)
    {
        $results = static::$client->priceRules->discountCodes->all($ids['priceRuleId']);

        $this->assertNotEmpty($results);
    }

    /**
     * @depends testCreateDiscountCode
     * @param array $ids
     * @return array
     */
    public function testGetDiscountCode(array $ids)
    {
        $item = static::$client->priceRules->discountCodes->get($ids['priceRuleId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetDiscountCode
     * @param array $ids
     */
    public function testUpdateDiscountCode(array $ids)
    {
        $item = static::$client->priceRules->discountCodes->update($ids['priceRuleId'], $ids['id'],
            $this->putDiscountCodeArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putDiscountCodeArray as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @depends testGetDiscountCode
     * @param array $ids
     * @internal param $id
     */
    public function testDeleteDiscountCode(array $ids)
    {
        static::$client->priceRules->discountCodes->delete($ids['priceRuleId'], $ids['id']);

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