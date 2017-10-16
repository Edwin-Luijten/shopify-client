<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/order_risks
 *
 * @method create(float $parentId, array $parameters = [])
 * @method get(float $parentId, float $childId)
 * @method all(float $parentId)
 * @method update(float $parentId, float $childId, array $parameters = [])
 * @method delete(float $parentId, float $childId)
 *
 * @property $risks
 */
class OrderRisk extends AbstractResource implements Resource
{
    /**
     * OrderRisk constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'orders/%s/risks.json',
                'risk',
                'risk'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'orders/%s/risks/%s.json',
                'risk',
                'risk'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'orders/%s/risks.json',
                'risks',
                'risks'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'orders/%s/risks/%s.json',
                'risk',
                'risk'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'orders/%s/risks/%s.json'
            )
        );
    }
}
