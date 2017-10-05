<?php

namespace ShopifyClient\Tests\Resource;

class PagesTest extends SimpleResource
{
    public function setUp()
    {
        parent::setUp();

        $this->postArray = [
            'title' => 'Warranty information',
            'body_html'  => '<h1>Warranty</h1>\n<p><strong>Forget it</strong>, we aint giving you nothing</p>',
            'published' => true,
        ];

        $this->putArray = [
            'title' => 'Terms of Services',
        ];
    }
}
