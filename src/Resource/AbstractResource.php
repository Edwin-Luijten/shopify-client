<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Exception\ClientException;
use ShopifyClient\Request;

abstract class AbstractResource
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
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
    }

    /**
     * @param string $action
     * @return array
     * @throws ClientException
     */
    public function getAction(string $action): array
    {
        if (!$this->hasAction($action)) {
            throw new ClientException(sprintf('Action: %s not found on resource. ', $action, get_called_class()));
        }

        return $this->actions[$action];
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
        if (!isset($this->actions[$action])) {
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
        $this->request->setResponseKey($this->getResponseKey($action));

        return $this->request->request(
            $this->getMethod($action),
            $this->getEndpoint($action, $parentId, $childId, $childChildId),
            $this->getRequestOptions($action, $parameters)
        );
    }

    /**
     * @param string $action
     * @param float|null $parentId
     * @param float|null $childId
     * @param float|null $childChildId
     * @return string
     * @throws ClientException
     */
    protected function getEndpoint(
        string $action,
        float $parentId = null,
        float $childId = null,
        float $childChildId = null
    ): string {
        $actionData = $this->getAction($action);

        if (!isset($actionData['endpoint'])) {
            throw new ClientException(sprintf('Endpoint key not set for action: %s.', $action));
        }

        return sprintf($actionData['endpoint'], $parentId, $childId, $childChildId);
    }

    /**
     * @param string $action
     * @return string
     * @throws ClientException
     */
    protected function getMethod(string $action): string
    {
        $actionData = $this->getAction($action);

        if (!isset($actionData['method'])) {
            throw new ClientException(sprintf('Method key not set for action: %s.', $action));
        }

        return $actionData['method'];
    }

    /**
     * @param string $action
     * @return string
     */
    protected function getResourceKey(string $action): string
    {
        $actionData = $this->getAction($action);

        if (!isset($actionData['resourceKey'])) {
            return '';
        }

        return $actionData['resourceKey'];
    }

    /**
     * @param string $action
     * @return string
     */
    protected function getResponseKey(string $action): string
    {
        $actionData = $this->getAction($action);

        if (!isset($actionData['responseKey'])) {
            return '';
        }

        return $actionData['responseKey'];
    }

    /**
     * @param string $action
     * @param array $parameters
     * @return array
     */
    private function getRequestOptions(string $action, array $parameters): array
    {
        $method      = $this->getMethod($action);
        $resourceKey = $this->getResourceKey($action);

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
