<?php

namespace ShopifyClient\Tests\Stubs;

use ShopifyClient\Resource\AbstractResource;
use ShopifyClient\Resource\Resource;

class InvalidResourceClassEndpoint extends AbstractResource implements Resource {
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoin'    => 'products.json',
            'resourceKey' => 'product',
        ],
    ];
}