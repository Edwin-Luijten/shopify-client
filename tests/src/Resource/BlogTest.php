<?php

namespace ShopifyClient\Tests\Resource;

class BlogTest extends SimpleResource
{
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

        $this->postArray = [
            'title' => 'Apple main blog',
        ];

        $this->putArray = [
            'title' => 'Apple blog',
        ];

        $this->postArticleArray = [
            'title'     => 'My new Article title',
            'author'    => 'John Smith',
            'tags'      => 'This Post, Has Been Tagged',
            'body_html' => '<h1>I like articles</h1>\n<p><strong>Yea</strong>, I like posting them through <span class="caps">REST</span>.</p>',

        ];

        $this->putArticleArray = [
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
     * @depends testGet
     * @param $id
     * @return array
     */
    public function testCreateArticle($id)
    {
        $item = static::$client->blog->articles->create($id, $this->postArticleArray);

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
        $results = static::$client->blog->articles->all($id);

        $this->assertNotEmpty($results);

        if (static::$client->blog->articles->isCountable()) {
            $count = static::$client->blog->articles->count($id);

            $items = [];
            $pages = $count <= 50 ? 1 : round($count / 50);

            for ($i = 1; $i <= $pages; $i++) {
                $items = array_merge($items, static::$client->blog->articles->throttle(function () use ($i, $id) {
                    return static::$client->blog->articles->all($id, [
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
        $item = static::$client->blog->articles->get($ids['blogId'], $ids['id']);

        $this->assertSame($item['id'], $ids['id']);

        return $ids;
    }

    /**
     * @depends testGetArticle
     * @param array $ids
     */
    public function testUpdateArticle(array $ids)
    {
        $item = static::$client->blog->articles->update($ids['blogId'], $ids['id'], $this->putArticleArray);

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
        $tags = static::$client->blog->articles->tags($id);

        $this->assertNotEmpty($tags);
    }

    public function testAuthors()
    {
        $tags = static::$client->blog->articles->authors();

        $this->assertNotEmpty($tags);
    }

    /**
     * @depends testGetArticle
     * @param array $ids
     */
    public function testDeleteArticle(array $ids)
    {
        static::$client->blog->articles->delete($ids['blogId'], $ids['id']);

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
