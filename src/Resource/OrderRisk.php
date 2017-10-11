<?php

namespace ShopifyClient\Resource;

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
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'orders/%s/risks.json',
            'resourceKey' => 'risk',
            'responseKey' => 'risk',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'orders/%s/risks/%s.json',
            'resourceKey' => 'risk',
            'responseKey' => 'risk',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'orders/%s/risks.json',
            'resourceKey' => 'risks',
            'responseKey' => 'risks',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'orders/%s/risks/%s.json',
            'resourceKey' => 'risk',
            'responseKey' => 'risk',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'orders/%s/risks/%s.json',
        ],
    ];
}
