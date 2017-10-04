<?php

namespace ShopifyClient\Resource;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use ShopifyClient\Exception\ClientException;

abstract class AbstractResource implements Resource
{
    const API_CALL_LIMIT_HEADER = 'http_x_shopify_shop_api_call_limit';

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var bool
     */
    protected $countable = false;

    /**
     * @var int
     */
    private $rateLimit;

    /**
     * @var int
     */
    private $callsMade;

    /**
     * @var float
     */
    private $callCycle = 0.5; // avg. 2 calls a second

    /**
     * @var float
     */
    private $rateLimitThreshold = 0.8;

    /**
     * @var int
     */
    private $rateLimitReached = 0;

    /**
     * AbstractResource constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->httpClient = $client;
    }

    /**
     * @param $method
     * @param $endpoint
     * @param array $params
     * @return array
     * @throws ClientException
     */
    public function request($method, $endpoint, $params = [])
    {
        $this->handleRateLimit();

        try {
            $response = $this->httpClient->request($method, $endpoint, $this->getRequestParameters($method, $params));
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $content  = json_decode($response->getBody()->getContents(), true);

            throw new ClientException($content['errors'], $response->getStatusCode());
        }

        $this->setRateLimit($response->getHeader(self::API_CALL_LIMIT_HEADER));

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return int
     */
    public function getRateLimitReached(): int
    {
        return $this->rateLimitReached;
    }

    /**
     * @param string $method
     * @param array $params
     * @return array
     */
    private function getRequestParameters(string $method, array $params): array
    {
        if ($method !== 'GET') {
            $params['headers']['Content-Type'] = 'application/json';
        }

        return $params;
    }

    private function handleRateLimit()
    {
        if ($this->callsMade > 0 && $this->isRateLimitReached()) {
            $this->rateLimitReached++;
            // Prevent bucket overflow
            // https://help.shopify.com/api/getting-started/api-call-limit
            usleep(rand(3, 10) * 1000000);
        }
    }

    /**
     * With a "leak rate" of 2 calls per second that continually empties the bucket.
     * If your app averages 2 calls per second, it will never trip a 429 error ("bucket overflow").
     *
     * @param callable $function
     * @return mixed
     */
    public function throttle(callable $function)
    {
        $start = time();

        $result = $function();

        $end = time();

        $duration = $end - $start;
        $waitTime = ceil($this->callCycle - $duration);

        if ($waitTime > 0) {
            sleep($waitTime);
        }

        return $result;
    }

    /**
     * @param array $header
     */
    private function setRateLimit(array $header)
    {
        $parts = explode('/', $header[0]);

        $this->rateLimit = $parts[1];
        $this->callsMade = $parts[0];
    }

    /**
     * @return bool
     */
    public function isRateLimitReached(): bool
    {
        return $this->getCallLimit() >= $this->rateLimitThreshold;
    }

    public function getCallLimit()
    {
        return $this->callsMade / $this->rateLimit;
    }

    /**
     * @return bool
     */
    public function isCountable(): bool
    {
        return $this->countable;
    }
}
