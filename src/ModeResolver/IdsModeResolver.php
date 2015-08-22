<?php

namespace Optimus\Architect\ModeResolver;

use Illuminate\Support\Collection;
use Optimus\Architect\ModeResolver\ModeResolverInterface;
use Optimus\Architect\Utility;

class IdsModeResolver implements ModeResolverInterface
{
    /**
     * Map through the collection and convert it to a collection
     * of ids
     * @param  string $property
     * @param  object $object
     * @param  array $root
     * @param  string $fullPropertyPath
     * @return mixed                   
     */
    public function resolve($property, &$object, &$root, $fullPropertyPath)
    {
        if (is_array($object)) {
            return array_map(function ($entry) {
                return (int) Utility::getProperty($entry, 'id');
            }, $object);
        } elseif ($object instanceof Collection) {
            return $object->map(function ($entry) {
                return (int) Utility::getProperty($entry, 'id');
            });
        }
    }
}
