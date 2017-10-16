<?php

namespace ShopifyClient\Action;

use ShopifyClient\Exception\ClientException;

class ActionCollection {
    /**
     * @var array
     */
    private $items = [];

    /**
     * @param $name
     * @param ActionInterface $action
     */
    public function add($name, ActionInterface $action) {
        $this->items[$name] = $action;
    }

    /**
     * @param $name
     * @return ActionInterface
     * @throws ClientException
     */
    public function get($name): ActionInterface {
        if (!$this->has($name)) {
            throw new ClientException(sprintf('%s action does not exist.', $name));
        }

        return $this->items[$name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name): bool {
        if (!isset($this->items[$name])) {
            return false;
        }

        return true;
    }
}