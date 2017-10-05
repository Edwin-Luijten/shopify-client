<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/product_image
 */
class ProductImage extends AbstractNestedCountableCrudResource
{
    /**
     * @var string
     */
    protected $resourceParentEndpointPleural = 'products';

    /**
     * @var string
     */
    protected $resourceChildEndpointPleural = 'images';

    /**
     * @var string
     */
    protected $resourceChildKeySingular = 'image';

    /**
     * @var string
     */
    protected $resourceChildKeyPleural = 'images';
}
