<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/fulfillment
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId, float $childId, array $parameters = [])
 * @method all(float $parentId, array $parameters = [])
 * @method count(float $parentId)
 * @method update(float $parentId, float $childId, array $parameters = [])
 * @method complete(float $parentId, float $childId)
 * @method open(float $parentId, float $childId)
 * @method cancel(float $parentId, float $childId)
 *
 * @property FulfillmentEvent $events
 */
class Fulfillment extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $childResources = [
        'events' => FulfillmentEvent::class,
    ];

    /**
     * Fulfillment constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'orders/%s/fulfillments.json',
                'fulfillment',
                'fulfillment'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'orders/%s/fulfillments/%s.json',
                'fulfillment',
                'fulfillment'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'orders/%s/fulfillments.json',
                'fulfillments',
                'fulfillments'
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
                'orders/%s/fulfillments/%s.json',
                'fulfillment',
                'fulfillment'
            )
        );
        $this->actions->add(
            'complete',
            new Action(
                Request::METHOD_POST,
                'orders/%s/fulfillments/%s/complete.json',
                'fulfillment',
                'fulfillment'
            )
        );
        $this->actions->add(
            'open',
            new Action(
                Request::METHOD_POST,
                'orders/%s/fulfillments/%s/open.json',
                'fulfillment',
                'fulfillment'
            )
        );
        $this->actions->add(
            'cancel',
            new Action(
                Request::METHOD_POST,
                'orders/%s/fulfillments/%s/cancel.json',
                'fulfillment',
                'fulfillment'
            )
        );
    }
}
