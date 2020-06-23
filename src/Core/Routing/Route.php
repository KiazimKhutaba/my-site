<?php


namespace Castels\Core\Routing;


class Route
{
    public $url = ""; // url маршрута
    public $handler = ""; // обработчик - метод класса
    public $methods = [];
    public $params = [];


    // for middleware
    public $before  = [];


    public function __construct(Annotation\Route $route, $params = [])
    {
        $this->url = $route->url;
        $this->handler = $route->handler;
        $this->methods = $route->methods;
        $this->params = $params;
        $this->before = $route->before;
    }


    public function __toString()
    {
        return sprintf(
            "@Route(url=\"%s\",handler=\"%s\",methods=\"%s\",params=\"%s\",before=\"%s\")",
            $this->url, $this->handler,
            join(',', $this->methods), join(',', $this->params), join(',',$this->before)
        );
    }
}
