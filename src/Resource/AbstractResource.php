<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Action\Action;
use ShopifyClient\Action\ActionCollection;
use ShopifyClient\Action\ActionInterface;
use ShopifyClient\Exception\ClientException;
use ShopifyClient\Request;

abstract class AbstractResource
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var ActionCollection
     */
    protected $actions = [];

    /**
     * @var array
     */
    protected $childResources = [];

    /**
     * AbstractResource constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->actions = new ActionCollection();
    }

    /**
     * @param string $action
     * @return ActionInterface
     * @throws ClientException
     */
    public function getAction(string $action): ActionInterface
    {
        return $this->actions->get($action);
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param string $action
     * @return bool
     */
    public function hasAction(string $action): bool
    {
        if (!$this->actions->has($action)) {
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getChildResources(): array
    {
        return $this->childResources;
    }

    /**
     * @param string $action
     * @param float|null $parentId
     * @param float|null $childId
     * @param float|null $childChildId
     * @param array|null $parameters
     * @return array|bool
     */
    protected function request(
        string $action,
        float $parentId = null,
        float $childId = null,
        float $childChildId = null,
        array $parameters = []
    ) {
        $action = $this->getAction($action);

        $this->request->setResponseKey($action->getResponseKey());

        return $this->request->request(
            $action->getMethod(),
            $this->getEndpoint($action, $parentId, $childId, $childChildId),
            $this->getRequestOptions($action, $parameters)
        );
    }

    /**
     * @param Action $action
     * @param float|null $parentId
     * @param float|null $childId
     * @param float|null $childChildId
     * @return string
     * @throws ClientException
     */
    protected function getEndpoint(
        Action $action,
        float $parentId = null,
        float $childId = null,
        float $childChildId = null
    ): string {
        return sprintf($action->getEndpoint(), $parentId, $childId, $childChildId);
    }

    /**
     * @param Action $action
     * @param array $parameters
     * @return array
     */
    private function getRequestOptions(Action $action, array $parameters): array
    {
        $method      = $action->getMethod();
        $resourceKey = $action->getResourceKey();

        if ($method === 'POST' || $method === 'PUT') {
            return strlen($resourceKey) < 1 ? [] : ['body' => json_encode([$resourceKey => $parameters])];
        }

        return [
            'query' => $parameters
        ];
    }

    /**
     * @param string $method
     * @param array|null $arguments
     * @return array|bool
     */
    public function __call(string $method, array $arguments = [])
    {
        return $this->request(
            $method,
            $this->getParentId($arguments),
            $this->getChildId($arguments),
            $this->getChildChildId($arguments),
            $this->getParameters($arguments)
        );
    }

    /**
     * @param array $arguments
     * @return float|null
     */
    private function getParentId(array $arguments)
    {
        $parentId = null;

        if (!empty($arguments[0])) {
            if (is_numeric($arguments[0])) {
                $parentId = $arguments[0];
            }
        }

        return $parentId;
    }

    /**
     * @param array $arguments
     * @return float|null
     */
    private function getChildId(array $arguments)
    {
        $childId = null;

        if (!empty($arguments[1])) {
            if (is_numeric($arguments[1])) {
                $childId = $arguments[1];
            }
        }

        return $childId;
    }

    /**
     * @param array $arguments
     * @return float|null
     */
    private function getChildChildId(array $arguments)
    {
        $childChildId = null;

        if (!empty($arguments[2])) {
            if (is_numeric($arguments[2])) {
                $childChildId = $arguments[2];
            }
        }

        return $childChildId;
    }

    /**
     * @param array $arguments
     * @return array
     */
    private function getParameters(array $arguments): array
    {
        foreach ($arguments as $value) {
            if (is_array($value)) {
                return $value;
            }
        }

        return [];
    }
}
