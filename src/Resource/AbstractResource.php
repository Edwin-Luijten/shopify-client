<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Exception\ClientException;
use ShopifyClient\Exception\ShopifyException;
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
    protected function getEndpoint(string $action, float $parentId = null, float $childId = null, float $childChildId = null): string
    {
        $actionData = $this->getAction($action);

        if (!isset($actionData['endpoint'])) {
            throw new ClientException(sprintf('Endpoint key not set for action: %s.', $action));
        }

        if (!empty($parentId) && empty($childId)) {
            return sprintf($actionData['endpoint'], $parentId);
        }

        if (!empty($parentId) && !empty($childId) && empty($childChildId)) {
            return sprintf($actionData['endpoint'], $parentId, $childId);
        }

        if (!empty($parentId) && !empty($childId) && !empty($childChildId)) {
            return sprintf($actionData['endpoint'], $parentId, $childId, $childChildId);
        }

        return $actionData['endpoint'];
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
        switch ($this->getMethod($action)) {
            case 'GET':
                return [
                    'query' => $parameters
                ];
                break;
            case 'POST':
            case 'PUT':
                if (strlen($this->getResourceKey($action)) < 1) {
                    return [];
                }

                return [
                    'body' => json_encode([
                        $this->getResourceKey($action) => $parameters
                    ])
                ];
                break;
            default:
                return [
                    'query' => $parameters
                ];
                break;
        }
    }

    /**
     * @param string $method
     * @param array|null $arguments
     * @return array|bool
     */
    public function __call(string $method, array $arguments = [])
    {
        $parentId     = null;
        $childId      = null;
        $childChildId = null;
        $parameters   = [];

        if (!empty($arguments[0])) {
            if (is_numeric($arguments[0])) {
                $parentId = $arguments[0];
            } elseif (is_array($arguments[0])) {
                $parameters = $arguments[0];
            }
        }

        if (!empty($arguments[1])) {
            if (is_numeric($arguments[1])) {
                $childId = $arguments[1];
            } elseif (is_array($arguments[1])) {
                $parameters = $arguments[1];
            }
        }

        if (!empty($arguments[2])) {
            if (is_numeric($arguments[2])) {
                $childChildId = $arguments[2];
            } elseif (is_array($arguments[2])) {
                $parameters = $arguments[2];
            }
        }

        if (!empty($arguments[3])) {
            if (is_array($arguments[3])) {
                $parameters = $arguments[3];
            }
        }

        return $this->request($method, $parentId, $childId, $childChildId, $parameters);
    }
}
