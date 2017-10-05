<?php

namespace ShopifyClient\Resource;

abstract class AbstractCountableCrudResource extends AbstractCrudResource
{
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
}
