<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/blog
 */
class Blog extends AbstractCrudResource
{
    /**
     * @var string
     */
    protected $resourceKeySingular = 'blog';

    /**
     * @var string
     */
    protected $resourceKeyPleural = 'blogs';

    /**
     * @var Article
     */
    public $articles;
}
