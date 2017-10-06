<?php

namespace ShopifyClient\Resource;

abstract class AbstractCountableCrudResource extends AbstractCrudResource
{
    /**
     * @param array $query
     * @return int
     */
    public function count(array $query = []): int
    {
        $response = $this->request('GET', sprintf('/admin/%s/count.json', $this->resourceKeyPleural), [
            'query' => $query
        ]);

        return $response['count'];
    }
}
