<?php

namespace ShopifyClient\Tests\Resource;

class ProductsTest extends SimpleResource
{
    public function setUp()
    {
        parent::setUp();

        $this->postArray = [
            'title'        => 'Burton Custom Freestyle 151',
            'body_html'    => '<strong>Good snowboard!<\/strong>',
            'vendor'       => 'Burton',
            'product_type' => 'Snowboard',
        ];

        $this->putArray = [
            'title' => 'Burton Custom Freestyle 500',
        ];
    }
}
