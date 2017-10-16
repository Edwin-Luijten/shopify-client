<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/abandoned_checkouts
 *
 * @method all(float $parentId)
 * @method count(float $parentId)
 */
class AbandonedCheckouts extends AbstractResource implements Resource
{
    /**
     * AbandonedCheckouts constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'checkouts.json',
                'checkouts',
                'checkouts'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'checkouts/count.json',
                'count',
                'count'
            )
        );
    }
}
