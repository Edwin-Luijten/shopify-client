<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/webhook
 */
class Webhook extends AbstractCrudResource
{
    /**
     * @var string
     */
    protected $resourceKeySingular = 'webhook';

    /**
     * @var string
     */
    protected $resourceKeyPleural = 'webhooks';

    /**
     * @var bool
     */
    protected $countable = true;
}
