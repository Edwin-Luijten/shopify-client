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
}
