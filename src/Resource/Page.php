<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/page
 */
class Page extends AbstractCountableCrudResource
{
    /**
     * @var string
     */
    protected $resourceKeySingular = 'page';

    /**
     * @var string
     */
    protected $resourceKeyPleural = 'pages';
}
