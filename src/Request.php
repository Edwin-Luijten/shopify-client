<?php

namespace ShopifyClient;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use ShopifyClient\Exception\ShopifyException;

class Request
{
    const API_CALL_LIMIT_HEADER = 'http_x_shopify_shop_api_call_limit';

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $responseKey;

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
    private static $callCycle = 0.5; // avg. 2 calls a second

    /**
     * @var float
     */
    private $rateLimitThreshold = 0.8;

    /**
     * @var int
     */
    private $rateLimitReached = 0;

    /**
     * Request constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->httpClient = $client;
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array $parameters
     * @return bool
     * @throws ShopifyException
     */
    public function request(string $method, string $endpoint, array $parameters = [])
    {
        $this->handleRateLimit();

        try {
            $response = $this->httpClient->request($method, $endpoint, $parameters);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $content  = json_decode($response->getBody()->getContents(), true);

            throw new ShopifyException($content['errors'], $response->getStatusCode(), $e);
        }

        $this->setRateLimit($response->getHeader(self::API_CALL_LIMIT_HEADER));

        $data = json_decode($response->getBody()->getContents(), true);

        if (strlen($this->responseKey) > 0) {
            return $data[$this->responseKey];
        } else {
            return true;
        }
    }

    /**
     * @param string $responseKey
     * @return Request
     */
    public function setResponseKey($responseKey)
    {
        $this->responseKey = $responseKey;
    }

    /**
     * @param callable $function
     * @return mixed
     */
    public static function throttle(callable $function)
    {
        $start    = time();
        $result   = $function();
        $end      = time();
        $duration = $end - $start;
        $waitTime = ceil(static::$callCycle - $duration);

        if ($waitTime > 0) {
            sleep($waitTime);
        }

        return $result;
    }

    /**
     * @return int
     */
    public function getRateLimitReached(): int
    {
        return $this->rateLimitReached;
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
     * @param array $header
     */
    private function setRateLimit(array $header)
    {
        if (empty($header)) {
            return;
        }

        $parts           = explode('/', $header[0]);
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

    /**
     * @return float|int
     */
    public function getCallLimit()
    {
        return $this->callsMade / $this->rateLimit;
    }
}
