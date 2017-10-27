<?php

namespace ShopifyClient\Tests\Integration\Resource;

class WebhooksTest extends SimpleResource
{
    public function setUp()
    {
        parent::setUp();

        $this->postArray = [
            'topic'   => 'orders/create',
            'address' => 'https://whatever.hostname.com/',
            'format'  => 'json',
        ];

        $this->putArray  = [
            'address' => 'https://whatever.hostname.com/foo',
        ];
    }
}