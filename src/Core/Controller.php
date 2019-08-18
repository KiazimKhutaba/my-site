<?php

namespace Castels\Core;


use Pimple\Container;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    protected $container;

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    public function render($template, array $data = [])
    {
        $content = $this->get('twig')->render($template, $data);
        return new Response($content);
    }

    public function get($service)
    {
        return $this->container[$service] ?? false;
    }
}