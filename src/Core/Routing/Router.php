<?php

namespace Castels\Core\Routing;


use Castels\Core\Exceptions\ResourceNotFoundException;
use Castels\Core\Routing\Annotation\Route;

class Router
{
    // массив для хранения соответствия url => функция
    public $routes = [];


    // данный метод принимает шаблон url-адреса
    // как шаблон регулярного выражения и связывает его
    // с пользовательской функцией

    public function addRoutes(array $routes = [])
    {
        foreach ($routes as $route) {
            //$this->addRoute($route->url, explode('::', $route->handler));
            $this->addRoute($route);
        }
    }


    public function addRoute(Route $route)
    {
        // функция str_replace здесь нужна, для экранирования всех прямых слешей
        // так как они используются в качестве маркеров регулярного выражения
        $route->url = '/^' . str_replace('/', '\/', $route->url) . '$/';
        //$route -> handler = explode('::', $route -> handler);

        $this->routes[] = $route;
    }


    public function getRoutes()
    {
        return $this->routes;
    }
    // данный метод проверяет запрошенный $url(адрес) на
    // соответствие адресам, хранящимся в массиве $routes

    public function match($url): \Castels\Core\Routing\Route
    {
        //$uri = parse_url($url, PHP_URL_PATH);
        //debug($url);

        foreach ($this->routes as $route) {
            if (preg_match($route->url, $url, $params)) // сравнение идет через регулярное выражение
            {
                // соответствие найдено, поэтому удаляем первый элемент из массива $params
                // который содержит всю найденную строку
                array_shift($params);
                //print_r($params);
                //return call_user_func_array($callback, array_values($params));
                return new \Castels\Core\Routing\Route($route, $params);
                //return [ "handler" => $handler, "args" => array_values($params)];
            }

        }

        //return "not found";
        throw new ResourceNotFoundException($url);
    }
}