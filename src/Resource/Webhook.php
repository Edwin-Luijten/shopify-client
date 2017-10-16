<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

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
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add(
            'create',
            new Action(
                Request::METHOD_POST,
                'webhooks.json',
                'webhook',
                'webhook'
            )
        );
        $this->actions->add(
            'get',
            new Action(
                Request::METHOD_GET,
                'webhooks/%s.json',
                'webhook',
                'webhook'
            )
        );
        $this->actions->add(
            'all',
            new Action(
                Request::METHOD_GET,
                'webhooks.json',
                'webhooks',
                'webhooks'
            )
        );
        $this->actions->add(
            'count',
            new Action(
                Request::METHOD_GET,
                'webhooks/count.json',
                'count',
                'count'
            )
        );
        $this->actions->add(
            'update',
            new Action(
                Request::METHOD_PUT,
                'webhooks/%s.json',
                'webhook',
                'webhook'
            )
        );
        $this->actions->add(
            'delete',
            new Action(
                Request::METHOD_DELETE,
                'webhooks/%s.json'
            )
        );
    }
}
