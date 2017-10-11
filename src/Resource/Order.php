<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/order
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId)
 * @method all(float $parentId)
 * @method count(float $parentId)
 * @method update(float $parentId, array $parameters = [])
 * @method open(float $parentId)
 * @method close(float $parentId)
 * @method cancel(float $parentId)
 * @method delete(float $parentId)
 *
 * @property OrderMetaField $metafields
 * @property OrderRisk $risks
 * @property Fulfillment $fulfillments
 */
class Order extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'orders.json',
            'resourceKey' => 'order',
            'responseKey' => 'order',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'orders/%s.json',
            'resourceKey' => 'order',
            'responseKey' => 'order',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'orders.json',
            'resourceKey' => 'orders',
            'responseKey' => 'orders',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'orders/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'orders/%s.json',
            'resourceKey' => 'order',
            'responseKey' => 'order',
        ],
        'open'   => [
            'method'      => 'POST',
            'endpoint'    => 'orders/%s/open.json',
            'responseKey' => 'order',
        ],
        'close'  => [
            'method'      => 'POST',
            'endpoint'    => 'orders/%s/close.json',
            'responseKey' => 'order',
        ],
        'cancel' => [
            'method'      => 'POST',
            'endpoint'    => 'orders/%s/cancel.json',
            'responseKey' => 'order',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'orders/%s.json',
        ],
    ];

    protected $childResources = [
        'metafields'   => OrderMetaField::class,
        'risks'        => OrderRisk::class,
        'fulfillments' => Fulfillment::class,
    ];
}
