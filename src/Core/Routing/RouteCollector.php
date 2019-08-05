<?php

namespace Castels\Core\Routing;

use Castels\Core\Routing\Annotation\Route;
use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass;
use ReflectionMethod;

// класс собирает все маршруты в массив

class RouteCollector
{
    // метод получает на вход строковое имя класса
    // который содержит роуты
    public function collectAll(array $classes)
    {
        $routes = [];
        foreach ($classes as $class) {
            $routes = array_merge($routes, $this->collect($class));
        }

        return $routes;
    }

    public function collect($class)
    {
        // объект класса AnnotationReader  из пакета doctrine/annotation
        $reader = new AnnotationReader();

        // загружаем класс в объект ReflectionClass
        $refClass = new ReflectionClass($class);

        $classAnnotation = $reader->getClassAnnotation($refClass, Route::class);
        //print_r($classAnnotation);
        //print_r($classAnnotation);

        // получаем из класса все публичные методы
        $refMethods = $refClass->getMethods(ReflectionMethod::IS_PUBLIC );

        // массив полученных объектов Route, описывающих маршрут
        $routes = [];
        foreach ($refMethods as $method) {
            // получаем аннотацию Route
            $methodAnnotation = $reader->getMethodAnnotation($method, Route::class);

            // если есть аннотация
            $route = new Route();
            if ($methodAnnotation) {
                if ($classAnnotation) {
                    $route->url = "{$classAnnotation -> url}{$methodAnnotation -> url}";
                    $route->handler = "{$class}::{$methodAnnotation->handler}";
                    $route->methods = array_merge($classAnnotation->methods, $methodAnnotation->methods);

                    $routes[] = $route;
                } else {
                    $route->url = $methodAnnotation->url;
                    $route->handler = "{$class}::{$methodAnnotation->handler}";
                    $route->methods = $methodAnnotation->methods;

                    $routes[] = $route;
                }
            }

        }

        return $routes;
    }


}