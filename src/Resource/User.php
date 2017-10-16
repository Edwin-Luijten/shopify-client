<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Request;

/**
 * https://help.shopify.com/api/reference/user
 *
 * @method get(float $parentId)
 * @method all
 * @method current(float $parentId)
 */
class User extends AbstractResource implements Resource
{
    /**
     * User constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->actions->add('get', new Action(Request::METHOD_GET, 'users/%s.json', 'user', 'user'));
        $this->actions->add('all', new Action(Request::METHOD_GET, 'users.json', 'users', 'users'));
        $this->actions->add('current', new Action(Request::METHOD_GET, 'users/%s.json', 'user', 'user'));
    }
}
