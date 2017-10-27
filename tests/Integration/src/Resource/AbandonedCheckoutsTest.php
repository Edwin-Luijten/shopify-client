<?php

namespace ShopifyClient\Tests\Resource\Integration;

use ShopifyClient\Request;
use ShopifyClient\Tests\Integration\BaseTest;

class AbandonedCheckoutsTest extends BaseTest
{
    public function testAll()
    {
        $results = static::$client->abandonedCheckouts->all();
        $this->assertEmpty($results);

        if (static::$client->abandonedCheckouts->hasAction('count')) {
            $count = static::$client->abandonedCheckouts->count();

            $items = [];
            $pages = $count <= 50 ? 1 : round($count / 50);

            for ($i = 1; $i <= $pages; $i++) {
                $items = array_merge($items, Request::throttle(function () use ($i) {
                    return static::$client->abandonedCheckouts->all([
                        'page' => $i,
                    ]);
                }));
            }

            $this->assertEquals($count, count($items));
        }
    }
}