<?php

namespace ShopifyClient\Tests\Resource;

class PriceRulesTest extends SimpleResource
{
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
    }
}
