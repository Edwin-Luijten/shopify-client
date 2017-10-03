<?php

namespace ShopifyClient\Tests\Resource;

class ProductsTest extends SimpleResource
{
    public $postArray = [
        'title'        => 'Burton Custom Freestyle 151',
        'body_html'    => '<strong>Good snowboard!<\/strong>',
        'vendor'       => 'Burton',
        'product_type' => 'Snowboard',
    ];

    public $putArray = [
        'title' => 'Burton Custom Freestyle 500',
    ];
}