<?php

namespace ShopifyClient\Tests\Resource;

use ShopifyClient\Tests\BaseTest;

class AbandonedCheckoutsTest extends BaseTest
{
    public function testAll()
    {
        $results = static::$client->abandonedCheckouts->all();

        $this->assertEmpty($results);

        if (method_exists(static::$client->abandonedCheckouts, 'count')) {
            $count = static::$client->abandonedCheckouts->count();

            $items = [];
            $pages = $count <= 50 ? 1 : round($count / 50);

            for ($i = 1; $i <= $pages; $i++) {
                $items = array_merge($items, static::$client->abandonedCheckouts->throttle(function () use ($i) {
                    return static::$client->abandonedCheckouts->all([
                        'page' => $i,
                    ]);
                }));
            }

            $this->assertEquals($count, count($items));
        }
    }
}