<?php

namespace ShopifyClient\Tests\Resource;

use ShopifyClient\Request;

class BlogsTest extends SimpleResource
{
    /**
     * @var array
     */
    private $postBlogMetafield = [];

    /**
     * @var array
     */
    private $putBlogMetafield = [];

    /**
     * @var array
     */
    private $postArticleArray = [];

    /**
     * @var array
     */
    private $putArticleArray = [];

    public function setUp()
    {
        parent::setUp();

        $this->postArray        = [
            'title' => 'Apple main blog',
        ];

        $this->putArray         = [
            'title' => 'Apple blog',
        ];

        $this->postBlogMetafield = [
            'namespace'  => 'inventory',
            'key'        => 'warehouse',
            'value'      => 25,
            'value_type' => 'integer',
        ];

        $this->putBlogMetafield = [
            'value' => 30,
        ];

        $this->postArticleArray = [
            'title'     => 'My new Article title',
            'author'    => 'John Smith',
            'tags'      => 'This Post, Has Been Tagged',
            'body_html' => '<h1>I like articles</h1>\n<p><strong>Yea</strong>, I like posting them through <span class="caps">REST</span>.</p>',
        ];

        $this->putArticleArray  = [
            'title' => 'My new Article',
        ];
    }

    public function testCreate()
    {
        return parent::testCreate();
    }

    public function testAll()
    {
        parent::testAll();
    }

    /**
     * @depends testCreate
     * @param $id
     */
    public function testGet($id)
    {
        return parent::testGet($id);
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testUpdate($id)
    {
        parent::testUpdate($id);
    }

    /**
     * @depends testCreate
     * @param $id
     * @return array
     */
    public function testCreateMetafield($id)
    {
        $item = static::$client->blogs->metafields->create($id, $this->postBlogMetafield);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return [
            'blogId' => $id,
            'id'        => $item['id'],
        ];
    }

    /**
     * @depends testCreateMetafield
     * @param array $ids
     */
    public function testAllMetafields(array $ids)
    {
        $results = static::$client->blogs->metafields->all($ids['blogId']);

        $this->assertNotEmpty($results);

        if (static::$client->orders->metafields->hasAction('count')) {
            $count = static::$client->blogs->metafields->count($ids['blogId']);

            $items = [];
            $pages = $count <= 50 ? 1 : round($count / 50);

            for ($i = 1; $i <= $pages; $i++) {
                $items = array_merge($items, Request::throttle(function () use ($i, $ids) {
                    return static::$client->blogs->metafields->all($ids['blogId'], [
                        'page' => $i,
                    ]);
                }));
            }

            $this->assertEquals($count, count($items));
        }
    }

    /**
     * @depends testCreateMetafield
     * @param array $ids
     * @return array
     */
    public function testGetMetafield(array $ids)
    {
        $item = static::$client->blogs->metafields->get($ids['blogId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetMetafield
     * @param array $ids
     */
    public function testUpdateMetafield(array $ids)
    {
        $item = static::$client->blogs->metafields->update($ids['blogId'], $ids['id'], $this->putBlogMetafield);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putBlogMetafield as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @depends testGet
     * @param $id
     * @return array
     */
    public function testCreateArticle($id)
    {
        $item = static::$client->blogs->articles->create($id, $this->postArticleArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return [
            'blogId' => $id,
            'id'     => $item['id'],
        ];
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testAllArticles($id)
    {
        $results = static::$client->blogs->articles->all($id);

        $this->assertNotEmpty($results);

        if (static::$client->blogs->articles->hasAction('count')) {
            $count = static::$client->blogs->articles->count($id);

            $items = [];
            $pages = $count <= 50 ? 1 : round($count / 50);

            for ($i = 1; $i <= $pages; $i++) {
                $items = array_merge($items, Request::throttle(function () use ($i, $id) {
                    return static::$client->blogs->articles->all($id, [
                        'page' => $i,
                    ]);
                }));
            }

            $this->assertEquals($count, count($items));
        }
    }

    /**
     * @depends testCreateArticle
     * @param array $ids
     * @return array
     */
    public function testGetArticle(array $ids)
    {
        $item = static::$client->blogs->articles->get($ids['blogId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetArticle
     * @param array $ids
     */
    public function testUpdateArticle(array $ids)
    {
        $item = static::$client->blogs->articles->update($ids['blogId'], $ids['id'], $this->putArticleArray);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putArticleArray as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testTags($id)
    {
        $tags = static::$client->blogs->articles->tags($id);

        $this->assertNotEmpty($tags);
    }

    public function testAuthors()
    {
        $tags = static::$client->blogs->articles->authors();

        $this->assertNotEmpty($tags);
    }

    /**
     * @depends testCreateArticle
     * @param array $ids
     * @return array
     */
    public function testCreateArticleMetafield(array $ids)
    {
        $item = static::$client->blogs->articles->metafields->create($ids['blogId'], $ids['id'], $this->postBlogMetafield);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        return [
            'blogId' => $ids['blogId'],
            'articleId' => $ids['id'],
            'id'        => $item['id'],
        ];
    }

    /**
     * @depends testCreateArticleMetafield
     * @param array $ids
     */
    public function testAllArticleMetafields(array $ids)
    {
        $results = static::$client->blogs->articles->metafields->all($ids['blogId'], $ids['articleId']);

        $this->assertNotEmpty($results);

        if (static::$client->products->variants->hasAction('count')) {
            $count = static::$client->blogs->articles->metafields->count($ids['blogId'], $ids['articleId']);

            $items = [];
            $pages = $count <= 50 ? 1 : round($count / 50);

            for ($i = 1; $i <= $pages; $i++) {
                $items = array_merge($items, Request::throttle(function () use ($i, $ids) {
                    return static::$client->blogs->articles->metafields->all($ids['blogId'], $ids['articleId'], [
                        'page' => $i,
                    ]);
                }));
            }

            $this->assertEquals($count, count($items));
        }
    }

    /**
     * @depends testCreateArticleMetafield
     * @param array $ids
     * @return array
     */
    public function testGetArticleMetafield(array $ids)
    {
        $item = static::$client->blogs->articles->metafields->get($ids['blogId'], $ids['articleId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetArticleMetafield
     * @param array $ids
     */
    public function testUpdateArticleMetafield(array $ids)
    {
        $item = static::$client->blogs->articles->metafields->update($ids['blogId'], $ids['articleId'], $ids['id'], $this->putBlogMetafield);

        $this->assertTrue(is_array($item));
        $this->assertNotEmpty($item);

        foreach ($this->putBlogMetafield as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @depends testGetArticleMetafield
     * @param array $ids
     */
    public function testDeleteArticleMetafield(array $ids)
    {
        static::$client->blogs->articles->metafields->delete($ids['blogId'], $ids['articleId'], $ids['id']);

        $this->assertTrue(true);
    }

    /**
     * @depends testGetArticle
     * @param array $ids
     */
    public function testDeleteArticle(array $ids)
    {
        static::$client->blogs->articles->delete($ids['blogId'], $ids['id']);

        $this->assertTrue(true);
    }

    /**
     * @depends testGetMetafield
     * @param array $ids
     */
    public function testDeleteMetafield(array $ids)
    {
        static::$client->blogs->metafields->delete($ids['blogId'], $ids['id']);

        $this->assertTrue(true);
    }

    /**
     * @depends testGet
     * @param $id
     */
    public function testDelete($id)
    {
        parent::testDelete($id);
    }
}