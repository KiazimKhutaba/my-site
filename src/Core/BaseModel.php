<?php


namespace Castels\Core;

use Castels\Core\Entity;


class BaseModel
{
    /**
     * Clean and trim article props
     *
     * @return array
     */
    public function trim($entity)
    {
        foreach ($entity as $propName => $propValue)
            $entity->{$propName} = trim($propValue);
    }
}