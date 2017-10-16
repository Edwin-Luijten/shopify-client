<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/customeraddress
 *
 * @method create(float $parentId, array $parameters = [])
 * @method get(float $parentId, float $childId)
 * @method all(float $parentId, array $parameters = [])
 * @method update(float $parentId, float $childId, array $parameters = [])
 * @method delete(float $parentId, float $childId)
 */
class CustomerAddress extends AbstractResource implements Resource
{
    /**
     * CustomerAddress constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'customers/%s/addresses.json',
                'customer_address',
                'address'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'customers/%s/addresses/%s.json',
                'customer_address',
                'customer_address'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'customers/%s/addresses.json',
                'addresses',
                'addresses'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'customers/%s/addresses/%s.json',
                'customer_address',
                'address'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'customers/%s/addresses/%s.json'
            )
        );
    }
}
