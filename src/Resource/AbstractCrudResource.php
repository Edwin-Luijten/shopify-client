<?php

namespace ShopifyClient\Resource;

abstract class AbstractCrudResource extends AbstractResource
{
    /**
     * @var string
     */
    protected $resourceKeySingular;

    /**
     * @var string
     */
    protected $resourceKeyPleural;

    /**
     * @param float $id
     * @param array $fields
     * @return array
     */
    public function get(float $id, array $fields = [])
    {
        $response = $this->request('GET', sprintf('/admin/%s/%s.json', $this->resourceKeyPleural, $id), [
            'query' => [
                'fields' => $fields
            ]
        ]);

        return $response[$this->resourceKeySingular];
    }

    /**
     * @param array $query
     * @return array
     */
    public function all(array $query = [])
    {
        $response = $this->request('GET', sprintf('/admin/%s.json', $this->resourceKeyPleural), [
            'query' => $query
        ]);

        return $response[$this->resourceKeyPleural];
    }

    /**
     * @param array $query
     * @return array
     */
    public function count(array $query = [])
    {
        $response = $this->request('GET', sprintf('/admin/%s/count.json', $this->resourceKeyPleural), [
            'query' => $query
        ]);

        return $response['count'];
    }

    /**
     * @param array $params
     * @return array
     */
    public function create(array $params = [])
    {
        $response = $this->request('POST', sprintf('/admin/%s.json', $this->resourceKeyPleural), [
            'body' => json_encode([
                $this->resourceKeySingular => $params,
            ]),
        ]);

        return $response[$this->resourceKeySingular];
    }

    /**
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/%s/%s.json', $this->resourceKeyPleural, $id), [
            'body' => json_encode([
                $this->resourceKeySingular => $params,
            ]),
        ]);

        return $response[$this->resourceKeySingular];
    }

    /**
     * @param float $id
     */
    public function delete(float $id)
    {
        $this->request('DELETE', sprintf('/admin/%s/%s.json', $this->resourceKeyPleural, $id));
    }
}