<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/abandoned_checkouts
 */
class AbandonedCheckout extends AbstractResource
{
    /**
     * @var bool
     */
    protected $countable = true;

    /**
     * @param array $query
     * @return array
     */
    public function all(array $query = [])
    {
        $response = $this->request('GET', '/admin/checkouts.json', [
            'query' => $query
        ]);

        return $response['checkouts'];
    }

    /**
     * @param array $query
     * @return array
     */
    public function count(array $query = [])
    {
        $response = $this->request('GET', '/admin/checkouts/count.json', [
            'query' => $query
        ]);

        return $response['count'];
    }
}
