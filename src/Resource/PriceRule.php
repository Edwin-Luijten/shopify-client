<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/pricerule
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId)
 * @method all(float $parentId)
 * @method count(float $parentId)
 * @method update(float $parentId, array $parameters = [])
 * @method delete(float $parentId)
 *
 * @property DiscountCode $discountCode
 */
class PriceRule extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'price_rules.json',
            'resourceKey' => 'price_rule',
            'responseKey' => 'price_rule',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'price_rules/%s.json',
            'resourceKey' => 'price_rule',
            'responseKey' => 'price_rule',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'price_rules.json',
            'resourceKey' => 'price_rules',
            'responseKey' => 'price_rules',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'price_rules/%s.json',
            'resourceKey' => 'price_rule',
            'responseKey' => 'price_rule',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'price_rules/%s.json',
        ],
    ];

    protected $childResources = [
        'discountCodes' => DiscountCode::class,
    ];
}
