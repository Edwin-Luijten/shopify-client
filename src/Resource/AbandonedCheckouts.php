<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/abandoned_checkouts
 *
 * @method all(float $parentId)
 * @method count(float $parentId)
 */
class AbandonedCheckouts extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'checkouts.json',
            'resourceKey' => 'checkouts',
            'responseKey' => 'checkouts',
        ],
        'count'  => [
            'method'      => 'GET',
            'endpoint'    => 'checkouts/count.json',
            'resourceKey' => 'count',
            'responseKey' => 'count',
        ],
    ];
}
