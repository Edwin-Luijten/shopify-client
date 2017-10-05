<?php

namespace ShopifyClient\Resource;

/**
 * https://help.shopify.com/api/reference/article
 */
class Article extends AbstractResource
{
    /**
     * @param float $blogId
     * @param float $id
     * @param array $fields
     * @return array
     */
    public function get(float $blogId, float $id, array $fields = [])
    {
        $response = $this->request('GET', sprintf('/admin/blogs/%s/articles/%s.json', $blogId, $id), [
            'query' => [
                'fields' => $fields
            ]
        ]);

        return $response['article'];
    }

    /**
     * @param float $id
     * @param array $query
     * @return array
     */
    public function all(float $id, array $query = [])
    {
        $response = $this->request('GET', sprintf('/admin/blogs/%s/articles.json', $id), [
            'query' => $query
        ]);

        return $response['articles'];
    }

    /**
     * @param float $id
     * @param array $query
     * @return array
     */
    public function count(float $id, array $query = [])
    {
        $response = $this->request('GET', sprintf('/admin/blogs/%s/articles/count.json', $id), [
            'query' => $query
        ]);

        return $response['count'];
    }

    /**
     * @param float $id
     * @param array $params
     * @return array
     */
    public function create(float $id, array $params = [])
    {
        $response = $this->request('POST', sprintf('/admin/blogs/%s/articles.json', $id), [
            'body' => json_encode([
                'article' => $params,
            ]),
        ]);

        return $response['article'];
    }

    /**
     * @param float $blogId
     * @param float $id
     * @param array $params
     * @return array
     */
    public function update(float $blogId, float $id, array $params = [])
    {
        $response = $this->request('PUT', sprintf('/admin/blogs/%s/articles/%s.json', $blogId, $id), [
            'body' => json_encode([
                'article' => $params,
            ]),
        ]);

        return $response['article'];
    }

    /**
     * @param float $blogId
     * @param float $id
     */
    public function delete(float $blogId, float $id)
    {
        $this->request('DELETE', sprintf('/admin/blogs/%s/articles/%s.json', $blogId, $id));
    }

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
