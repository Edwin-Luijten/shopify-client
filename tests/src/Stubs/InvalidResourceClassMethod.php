<?php

namespace ShopifyClient\Tests\Stubs;

use ShopifyClient\Resource\AbstractResource;
use ShopifyClient\Resource\Resource;

class InvalidResourceClassMethod extends AbstractResource implements Resource {
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'metho'      => 'POST',
            'endpoint'    => 'products.json',
            'resourceKey' => 'product',
        ],
    ];
}