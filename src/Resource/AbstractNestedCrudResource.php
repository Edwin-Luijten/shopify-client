<?php

namespace ShopifyClient\Resource;

abstract class AbstractNestedCrudResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $resourceParentEndpointPleural;

    /**
     * @var string
     */
    protected $resourceChildEndpointPleural;

    /**
     * @var string
     */
    protected $resourceChildKeySingular;

    /**
     * @var string
     */
    protected $resourceChildKeyPleural;

    /**
     * @param float $parentId
     * @param float $id
     * @param array $fields
     * @return array
     */
    public function get(float $parentId, float $id, array $fields = []): array
    {
        $response = $this->request('GET', sprintf(
            '/admin/%s/%s/%s/%s.json',
            $this->resourceParentEndpointPleural,
            $parentId,
            $this->resourceChildEndpointPleural,
            $id
        ), [
            'query' => [
                'fields' => $fields
            ]
        ]);

        return $response[$this->resourceChildKeySingular];
    }

    /**
     * @param float $parentId
     * @param array $query
     * @return array
     */
    public function all(float $parentId, array $query = []): array
    {
        $response = $this->request('GET', sprintf(
            '/admin/%s/%s/%s.json',
            $this->resourceParentEndpointPleural,
            $parentId,
            $this->resourceChildEndpointPleural
        ), [
            'query' => $query
        ]);

        return $response[$this->resourceChildKeyPleural];
    }

    /**
     * @param float $parentId
     * @param array $params
     * @return array
     */
    public function create(float $parentId, array $params = []): array
    {
        $response = $this->request('POST', sprintf(
            '/admin/%s/%s/%s.json',
            $this->resourceParentEndpointPleural,
            $parentId,
            $this->resourceChildEndpointPleural
        ), [
            'body' => json_encode([
                $this->resourceChildKeySingular => $params,
            ]),
        ]);

        return $response[$this->resourceChildKeySingular];
    }

    /**
     * @param float $parentId
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $parentId, float $id, array $params = []): array
    {
        $response = $this->request('PUT', sprintf(
            '/admin/%s/%s/%s/%s.json',
            $this->resourceParentEndpointPleural,
            $parentId,
            $this->resourceChildEndpointPleural,
            $id
        ), [
            'body' => json_encode([
                $this->resourceChildKeySingular => $params,
            ]),
        ]);

        return $response[$this->resourceChildKeySingular];
    }

    /**
     * @param float $parentId
     * @param float $id
     */
    public function delete(float $parentId, float $id)
    {
        $this->request('DELETE', sprintf(
            '/admin/%s/%s/%s/%s.json',
            $this->resourceParentEndpointPleural,
            $parentId,
            $this->resourceChildEndpointPleural,
            $id
        ));
    }
}
