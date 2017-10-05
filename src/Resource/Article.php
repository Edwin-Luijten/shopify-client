<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/article
 */
class Article extends AbstractNestedCountableCrudResource
{
    /**
     * @var string
     */
    protected $resourceParentEndpointPleural = 'blogs';

    /**
     * @var string
     */
    protected $resourceChildEndpointPleural = 'articles';

    /**
     * @var string
     */
    protected $resourceChildKeySingular = 'article';

    /**
     * @var string
     */
    protected $resourceChildKeyPleural = 'articles';

    /**
     * @param float $id
     * @param array $query
     * @return array
     */
    public function tags(float $id, array $query = [])
    {
        $response = $this->request('GET', sprintf('/admin/blogs/%s/articles/tags.json', $id), [
            'query' => $query,
        ]);

        return $response['tags'];
    }

    /**
     * @return array
     */
    public function authors()
    {
        $response = $this->request('GET', '/admin/articles/authors.json');

        return $response['authors'];
    }
}
