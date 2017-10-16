<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/fulfillmentservice
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId)
 * @method all(float $parentId, array $parameters = [])
 * @method update(float $parentId, array $parameters = [])
 * @method delete(float $parentId)
 */
class FulfillmentService extends AbstractResource implements Resource
{
    /**
     * FulfillmentService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'fulfillment_services.json',
                'fulfillment_service',
                'fulfillment_service'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'fulfillment_services/%s.json',
                'fulfillment_service',
                'fulfillment_service'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'fulfillment_services.json',
                'fulfillment_services',
                'fulfillment_services'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'orders/%s/fulfillments/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'fulfillment_services/%s.json',
                'fulfillment_service',
                'fulfillment_service'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'fulfillment_services/%s.json'
            )
        );
    }
}
