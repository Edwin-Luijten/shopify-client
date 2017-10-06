<?php

namespace ShopifyClient\Resource;

abstract class AbstractNestedCountableCrudResource extends AbstractNestedCrudResource
{
    /**
     * @param float $parentId
     * @param array $query
     * @return int
     */
    public function count(float $parentId, array $query = []): int
    {
        $response = $this->request('GET', sprintf(
            '/admin/%s/%s/%s/count.json',
            $this->resourceParentEndpointPleural,
            $parentId,
            $this->resourceChildEndpointPleural
        ), [
            'query' => $query
        ]);

        return $response['count'];
    }
}
