<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/user
 *
 * @method get(float $parentId)
 * @method all(float $parentId)
 * @method current(float $parentId)
 */
class User extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'get'     => [
            'method'      => 'GET',
            'endpoint'    => 'users/%s.json',
            'resourceKey' => 'user',
            'responseKey' => 'user',
        ],
        'all'     => [
            'method'      => 'GET',
            'endpoint'    => 'users.json',
            'resourceKey' => 'users',
            'responseKey' => 'users',
        ],
        'current' => [
            'method'      => 'POST',
            'endpoint'    => 'users/%s.json',
            'resourceKey' => 'user',
            'responseKey' => 'user',
        ],
    ];
}
