<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/country
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId)
 * @method all(float $parentId)
 * @method count(float $parentId)
 * @method update(float $parentId, array $parameters = [])
 * @method delete(float $parentId)
 */
class Country extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $childResources = [
        'provinces' => Province::class,
    ];

    /**
     * Country constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'countries.json',
                'country',
                'country'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'countries/%s.json',
                'country',
                'country'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'countries.json',
                'countries',
                'countries'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'countries/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'countries/%s.json',
                'country',
                'country'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'countries/%s.json'
            )
        );
    }
}
