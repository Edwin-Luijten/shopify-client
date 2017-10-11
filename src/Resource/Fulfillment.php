<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/fulfillment
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId, float $childId, array $parameters = [])
 * @method all(float $parentId, array $parameters = [])
 * @method count(float $parentId)
 * @method update(float $parentId,  float $childId, array $parameters = [])
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
    protected $actions = [
        'create'   => [
            'method'      => 'POST',
            'endpoint'    => 'orders/%s/fulfillments.json',
            'resourceKey' => 'fulfillment',
            'responseKey' => 'fulfillment',
        ],
        'get'      => [
            'method'      => 'GET',
            'endpoint'    => 'orders/%s/fulfillments/%s.json',
            'resourceKey' => 'fulfillment',
            'responseKey' => 'fulfillment',
        ],
        'all'      => [
            'method'      => 'GET',
            'endpoint'    => 'orders/%s/fulfillments.json',
            'resourceKey' => 'fulfillments',
            'responseKey' => 'fulfillments',
        ],
        'count'    => [
            'method'      => 'GET',
            'endpoint'    => 'orders/%s/fulfillments/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update'   => [
            'method'      => 'PUT',
            'endpoint'    => 'orders/%s/fulfillments/%s.json',
            'resourceKey' => 'fulfillment',
            'responseKey' => 'fulfillment',
        ],
        'complete' => [
            'method'      => 'POST',
            'endpoint'    => 'orders/%s/fulfillments/%s/complete.json',
            'resourceKey' => 'fulfillment',
            'responseKey' => 'fulfillment',
        ],
        'open'     => [
            'method'      => 'POST',
            'endpoint'    => 'orders/%s/fulfillments/%s/open.json',
            'resourceKey' => 'fulfillment',
            'responseKey' => 'fulfillment',
        ],
        'cancel'   => [
            'method'      => 'POST',
            'endpoint'    => 'orders/%s/fulfillments/%s/cancel.json',
            'resourceKey' => 'fulfillment',
            'responseKey' => 'fulfillment',
        ],
    ];

    protected $childResources = [
        'events' => FulfillmentEvent::class,
    ];
}
