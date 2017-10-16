<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

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
    protected $childResources = [
        'metafields' => ShopMetaField::class,
    ];

    /**
     * Shop constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'shop.json',
                'shop'
            )
        );
    }
}
