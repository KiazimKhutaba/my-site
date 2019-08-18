<?php

namespace Castels\Core\Routing\Annotation;
/**
 * Аннотация \@Route представлена классом Route (маршрут)
 * Данная аннотация хранит настройки маршрутизации
 *
 *
 * @Annotation - обозначение аннотации
 * @Target({"CLASS","METHOD"}) - аннотация может применяться только к классам и методам классов
 */
class Route
{
    public $name = "";
    public $url = ""; // url маршрута
    public $handler = ""; // обработчик - метод класса
    public $methods = [];


    public function __toString()
    {
        return sprintf(
            "@Route(url=\"%s\",handler=\"%s\",methods=\"%s\")",
            $this->url, $this->handler, join(',', $this->methods)
        );
    }
}
