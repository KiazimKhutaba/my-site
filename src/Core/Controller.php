<?php

namespace Castels\Core;


use Pimple\Container;

class Controller
{
    protected $container;

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }


    public function get($service)
    {
        return isset($this->container[$service])
            ? $this->container[$service] : false;
    }
}