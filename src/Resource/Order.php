<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/order
 *
 * @method create(array $parameters = [])
 * @method get(float $parentId)
 * @method all(float $parentId)
 * @method count(float $parentId)
 * @method update(float $parentId, array $parameters = [])
 * @method open(float $parentId)
 * @method close(float $parentId)
 * @method cancel(float $parentId)
 * @method delete(float $parentId)
 *
 * @property OrderMetaField $metafields
 * @property OrderRisk $risks
 * @property Fulfillment $fulfillments
 */
class Order extends AbstractResource implements Resource
{
    /**
     * @var array
     */
    protected $childResources = [
        'metafields'   => OrderMetaField::class,
        'risks'        => OrderRisk::class,
        'fulfillments' => Fulfillment::class,
    ];

    /**
     * Order constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'orders.json',
                'order',
                'order'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'orders/%s.json',
                'order',
                'order'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'orders.json',
                'orders',
                'orders'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'orders/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'orders/%s.json',
                'order',
                'order'
            )
        );
        $this->actions->add(
            'open',
            new Action(
                Request::METHOD_POST,
                'orders/%s/open.json',
                'order',
                'order'
            )
        );
        $this->actions->add(
            'close',
            new Action(
                Request::METHOD_POST,
                'orders/%s/close.json',
                'order',
                'order'
            )
        );
        $this->actions->add(
            'cancel',
            new Action(
                Request::METHOD_POST,
                'orders/%s/cancel.json',
                'order',
                'order'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'orders/%s.json'
            )
        );
    }


}
