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
        return $this->buildErrorString($this->errors);
    }

    /**
     * @param $errors
     * @param string $errorString
     * @param null|string $field
     * @return string
     */
    private function buildErrorString($errors, $errorString = '', string $field = null): string
    {
        foreach ($errors as $key => $value) {
            if (is_array($value)) {
                $errorString .= $this->buildErrorString($value, $errorString, $key);
            } else {
                $errorString .= $this->buildErrorLine($field, $value);
            }
        }

        return $errorString;
    }

    /**
     * @param $key
     * @param string $value
     * @return string
     */
    private function buildErrorLine($key, string $value = null): string
    {
        return sprintf('%s%s.', !empty($key) ? $key . ': ' : $key, $value) . PHP_EOL;
    }
}
