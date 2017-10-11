<?php

namespace ShopifyClient\Resource;

use ShopifyClient\Exception\ResourceException;
use ShopifyClient\Request;

class ResourceFactory
{
    /**
     * @param Request $request
     * @param string $resource
     * @return Resource
     * @throws ResourceException
     */
    public static function build(Request $request, string $resource): Resource
    {
        if (class_exists($resource)) {
            return self::instantiateResource(new $resource($request), $request);
        } else {
            throw new ResourceException(sprintf('Resource %s class does not exist.', $resource));
        }
    }

    /**
     * @param Resource $instance
     * @param Request $request
     * @return Resource
     */
    private static function instantiateResource(Resource $instance, Request $request): Resource
    {
        if (!empty($instance->getChildResources())) {
            foreach ($instance->getChildResources() as $property => $childResource) {
                $instance->{$property} = new $childResource($request);

                if (!empty($instance->{$property}->getChildResources())) {
                    self::instantiateResource($instance->{$property}, $request);
                }
            }
        }

        return $instance;
    }
}
