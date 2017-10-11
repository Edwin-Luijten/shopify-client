<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/webhook
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId)
 * @method all(float $parentId)
 * @method update(float $parentId, array $parameters = [])
 * @method delete(float $parentId)
 */
class Webhook extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $actions = [
        'create' => [
            'method'      => 'POST',
            'endpoint'    => 'webhooks.json',
            'resourceKey' => 'webhook',
            'responseKey' => 'webhook',
        ],
        'get'    => [
            'method'      => 'GET',
            'endpoint'    => 'webhooks/%s.json',
            'resourceKey' => 'webhook',
            'responseKey' => 'webhook',
        ],
        'all'    => [
            'method'      => 'GET',
            'endpoint'    => 'webhooks.json',
            'resourceKey' => 'webhooks',
            'responseKey' => 'webhooks',
        ],
        'update' => [
            'method'      => 'PUT',
            'endpoint'    => 'webhooks/%s.json',
            'resourceKey' => 'webhook',
            'responseKey' => 'webhook',
        ],
        'delete' => [
            'method'   => 'DELETE',
            'endpoint' => 'webhooks/%s.json',
        ],
    ];
}
