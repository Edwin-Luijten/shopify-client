<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/fulfillmentevent
 *
 * @method create(float $parentId, float $childId, array $parameters = [])
 * @method get(float $parentId, float $childId, float $childChildId, array $parameters = [])
 * @method all(float $parentId, float $childId, array $parameters = [])
 * @method delete(float $parentId, float $childId, float $childChildId)
 */
class FulfillmentEvent extends AbstractResource implements Resource
{
    /**
     * FulfillmentEvent constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'orders/%s/fulfillments/%s/events.json',
                'fulfillment_event',
                'event'

            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'orders/%s/fulfillments/%s/events/%s.json',
                'fulfillment_event',
                'fulfillment_event'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'orders/%s/fulfillments/%s/events.json',
                'fulfillment_events',
                'fulfillment_events'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'orders/%s/fulfillments/%s/events/%s.json'
            )
        );
    }
}
