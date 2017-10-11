<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/shop
 *
 * @method get
 *
 * @property ShopMetaField $metafields
 */
class Shop extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [

        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'shop.json',
            'responseKey' => 'shop',
        ],
    ];

    /**
     * @var array
     */
    protected $childResources = [
        'metafields' => ShopMetaField::class,
    ];
}
