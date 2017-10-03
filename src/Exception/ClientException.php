<?php

namespace ShopifyClient\Exception;

use Throwable;

class ClientException extends \Exception
{
    /**
     * @var array
     */
    protected $errors;

    /**
     * ClientException constructor.
     * @param string|array $errors
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($errors, $code = 0, Throwable $previous = null)
    {
        if (!is_array($errors)) {
            $errors = [$errors];
        }

        $this->errors = $errors;

        parent::__construct('Shopify exception: ' . $this->__toString(), $code, $previous);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $error = '';

        foreach ($this->errors as $key => $value) {
            $error .= sprintf('%s%s.', !is_numeric($key) ? $key . ': ' : '', $value) . PHP_EOL;
        }

        return $error;
    }
}
