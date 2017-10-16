<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/customer
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId)
 * @method all(float $parentId)
 * @method count(float $parentId)
 * @method update(float $parentId, array $parameters = [])
 * @method delete(float $parentId)
 *
 * @property ProductMetaField $metafields
 * @property CustomerAddress $addresses
 */
class Customer extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $childResources = [
        'metafields' => CustomerMetaField::class,
        'addresses'  => CustomerAddress::class,
    ];

    /**
     * Customer constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'customers.json',
                'customer',
                'customer'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'customers/%s.json',
                'customer',
                'customer'
            )
        );
        $this->actions->add(
            'search',
            new Action(
                Request::METHOD_GET,
                'customers/search.json',
                'customers',
                'customers'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'customers.json',
                'customers',
                'customers'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'customers/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'customers/%s.json',
                'customer',
                'customer'
            )
        );
        $this->actions->add(
            'orders',
            new Action(
                Request::METHOD_GET,
                'customers/%s/orders.json',
                'orders',
                'orders'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'customers/%s.json'
            )
        );
    }
}
