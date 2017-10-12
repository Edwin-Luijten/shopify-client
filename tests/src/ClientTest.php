<?php

namespace ShopifyClient\Tests;

use ShopifyClient\Client;
use ShopifyClient\Config;
use ShopifyClient\Resource\Resource;
use ShopifyClient\Tests\Stubs\InvalidResourceClassEndpoint;
use ShopifyClient\Tests\Stubs\InvalidResourceClassMethod;

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
    public function testCreateClientWithInvalidResource()
    {
        $client = new Client(
            new Config(
                getenv('SHOPIFY_DOMAIN'),
                getenv('SHOPIFY_KEY'),
                getenv('SHOPIFY_SECRET'),
                [
                    'foo' => 'Bar',
                ]
            )
        );

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testGetResource()
    {
        $resource = static::$client->getResource('products');

        $this->assertInstanceOf(Resource::class, $resource);
    }

    /**
     * @expectedException \ShopifyClient\Exception\ResourceException
     */
    public function testGetInvalidResource()
    {
        static::$client->getResource('foo');
    }

    /**
     * @expectedException \ShopifyClient\Exception\ClientException
     */
    public function testInvalidResourceClassMethod() {
        $client = new Client(
            new Config(
                getenv('SHOPIFY_DOMAIN'),
                getenv('SHOPIFY_KEY'),
                getenv('SHOPIFY_SECRET'),
                [
                    'foo' => InvalidResourceClassMethod::class,
                ]
            )
        );

        $this->assertInstanceOf(Client::class, $client);

        $client->foo->create(1, []);
    }

    /**
     * @expectedException \ShopifyClient\Exception\ClientException
     */
    public function testInvalidResourceClassEndpoint() {
        $client = new Client(
            new Config(
                getenv('SHOPIFY_DOMAIN'),
                getenv('SHOPIFY_KEY'),
                getenv('SHOPIFY_SECRET'),
                [
                    'foo' => InvalidResourceClassEndpoint::class,
                ]
            )
        );

        $this->assertInstanceOf(Client::class, $client);

        $client->foo->create(1, []);
    }
}
