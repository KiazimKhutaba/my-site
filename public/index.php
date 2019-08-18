<?php

use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';


error_reporting(E_ALL);


$app = new Castels\Application();
$response = $app->handle(Request::createFromGlobals());
$response->send();


# print sprintf("<pre>%s</pre>\n",print_r(Request::createFromGlobals(),1));