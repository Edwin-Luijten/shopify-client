<?php

namespace ShopifyClient\Tests\Resource;

class CountriesTest extends SimpleResource
{
    public function setUp()
    {
        parent::setUp();

        $this->postArray = [
            'code' => 'FR',
            'tax'  => 0.25,
        ];

        $this->putArray = [
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

    public function testCreateProvince()
    {
        return parent::testCreate();
    }

    public function testAllProvinces()
    {
        parent::testAll();
    }

    /**
     * @depends testCreate
     * @param $id
     */
    public function testGetProvince($id)
    {
        return parent::testGet($id);
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testUpdateProvince($id)
    {
        parent::testUpdate($id);
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testDeleteProvince($id)
    {
        parent::testDelete($id);
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
