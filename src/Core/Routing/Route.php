<?php


namespace Castels\Core\Routing;


class Route
{
    public $url = ""; // url маршрута
    public $handler = ""; // обработчик - метод класса
    public $methods = [];
    public $params = [];


    public function __construct(Annotation\Route $route, $params = [])
    {
        $this->url = $route->url;
        $this->handler = $route->handler;
        $this->methods = $route->methods;
        $this->params = $params;
    }


    public function __toString()
    {
        return sprintf(
            "@Route(url=\"%s\",handler=\"%s\",methods=\"%s\",params=\"%s\")",
            $this->url, $this->handler,
            join(',', $this->methods), join(',', $this->params)
        );
    }
}
