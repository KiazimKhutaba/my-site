<?php

namespace Castels\Core;


use Pimple\Container;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    protected $container;

    /**
     * Setup service container
     * @param Container $container
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Render template and return Response object
     * @param $template
     * @param array $data
     * @return Response
     */
    public function render($template, array $data = [])
    {
        $content = $this->get("twig")->render($template, $data);
        return new Response($content);
    }

    /**
     * Only render template and return it's ready content
     * @param $template
     * @param array $data
     * @return
     */
    public function renderView($template,array $data = []) 
    {
        return $this->get("twig")->render($template,$data);
    }

    /**
     * Return service by it unique id
     * @param string $service
     * @return
     */
    public function get($service)
    {
        return $this->container[$service];
    }


    public function redirect($url) {
        return new RedirectResponse($url);
    }
}