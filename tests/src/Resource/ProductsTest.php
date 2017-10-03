<?php

namespace ShopifyClient\Tests\Resource;

class ProductsTest extends SimpleResource
{
    public $postArray = [
        'product' => [
            'title'        => 'Burton Custom Freestyle 151',
            'body_html'    => '<strong>Good snowboard!<\/strong>',
            'vendor'       => 'Burton',
            'product_type' => 'Snowboard',
        ]
    ];

    public $putArray = [
        'product' => [
            'title'        => 'Burton Custom Freestyle 500',
        ]
    ];
}