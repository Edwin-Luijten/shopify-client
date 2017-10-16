<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/province
 *
 * @method get(float $parentId, float $childId)
 * @method all(float $parentId)
 * @method count(float $parentId)
 * @method update(float $parentId, float $childId, array $parameters = [])
 */
class Province extends AbstractResource implements Resource
{
    /**
     * Province constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'countries/%s/provinces/%s.json',
                'province',
                'province'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'countries/%s/provinces.json',
                'provinces',
                'provinces'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'countries/%s/provinces/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'countries/%s/provinces/%s.json',
                'province',
                'province'
            )
        );
    }
}
