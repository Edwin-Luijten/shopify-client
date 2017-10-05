<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/product
 */
class Product extends AbstractCrudResource
{
    /**
     * @var string
     */
    protected $resourceKeySingular = 'product';

    /**
     * @var string
     */
    protected $resourceKeyPleural = 'products';

    /**
     * @var ProductVariant
     */
    public $variants;

    /**
     * @var ProductImage
     */
    public $images;
}
