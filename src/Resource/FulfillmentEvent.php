<?php

namespace ShopifyClient\Resource;

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
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'orders/%s/fulfillments/%s/events.json',
            'resourceKey' => 'event',
            'responseKey' => 'fulfillment_event',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'orders/%s/fulfillments/%s/events/%s.json',
            'resourceKey' => 'fulfillment_event',
            'responseKey' => 'fulfillment_event',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'orders/%s/fulfillments/%s/events.json',
            'resourceKey' => 'fulfillment_events',
            'responseKey' => 'fulfillment_events',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'orders/%s/fulfillments/%s/events/%s.json',
        ],
    ];
}
