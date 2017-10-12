<?php

namespace ShopifyClient\Resource;

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
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'fulfillment_services.json',
            'resourceKey' => 'fulfillment_service',
            'responseKey' => 'fulfillment_service',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'fulfillment_services/%s.json',
            'resourceKey' => 'fulfillment_service',
            'responseKey' => 'fulfillment_service',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'fulfillment_services.json',
            'resourceKey' => 'fulfillment_services',
            'responseKey' => 'fulfillment_services',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'orders/%s/fulfillments/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'fulfillment_services/%s.json',
            'resourceKey' => 'fulfillment_service',
            'responseKey' => 'fulfillment_service',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'fulfillment_services/%s.json',
        ],
    ];
}
