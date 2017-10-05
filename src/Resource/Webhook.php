<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/webhook
 */
class Webhook extends AbstractCountableCrudResource
{
    /**
     * @var string
     */
    protected $resourceKeySingular = 'webhook';

    /**
     * @var string
     */
    protected $resourceKeyPleural = 'webhooks';
}
