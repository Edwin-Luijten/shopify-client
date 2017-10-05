<?php

namespace ShopifyClient\Tests\Resource;

class CarrierServicesTest extends SimpleResource
{
    public function setUp()
    {
        parent::setUp();

        $this->postArray = [
            'name'              => 'Shipping Rate Provider',
            'callback_url'      => 'http://shippingrateprovider.com',
            'service_discovery' => true,
        ];

        $this->putArray = [
            'name'   => 'Some new name',
            'active' => false,
        ];
    }
}
