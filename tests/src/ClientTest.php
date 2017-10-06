<?php

namespace ShopifyClient\Tests;

use ShopifyClient\Client;
use ShopifyClient\Config;
use ShopifyClient\Resource\Resource;

class ClientTest extends BaseTest
{
    public function testPrivateCreateClient()
    {
        $client = new Client(
            new Config(
                getenv('SHOPIFY_DOMAIN'),
                getenv('SHOPIFY_KEY'),
                getenv('SHOPIFY_SECRET')
            )
        );

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testPublicCreateClient()
    {
        $client = new Client(
            new Config(
                getenv('SHOPIFY_DOMAIN'),
                getenv('SHOPIFY_KEY'),
                getenv('SHOPIFY_SECRET'),
                [],
                'foobar'
            )
        );

        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * @expectedException \ShopifyClient\Exception\ResourceException
     */
    public function testInvalidResourceConfigString()
    {
        new Client(
            new Config(
                getenv('SHOPIFY_DOMAIN'),
                getenv('SHOPIFY_KEY'),
                getenv('SHOPIFY_SECRET'),
                [
                    'foo' => 'bar',
                ]
            )
        );
    }

    /**
     * @expectedException \ShopifyClient\Exception\ResourceException
     */
    public function testInvalidResourceConfigArray()
    {
        new Client(
            new Config(
                getenv('SHOPIFY_DOMAIN'),
                getenv('SHOPIFY_KEY'),
                getenv('SHOPIFY_SECRET'),
                [
                    'foo' => [
                        'bar' => 'baz',
                    ],
                ]
            )
        );
    }

    public function testGetResource()
    {
        $resource = static::$client->getResource('customers');

        $this->assertInstanceOf(Resource::class, $resource);
    }

    /**
     * @expectedException \ShopifyClient\Exception\ResourceException
     */
    public function testGetInvalidResource()
    {
        static::$client->getResource('foo');
    }
}
