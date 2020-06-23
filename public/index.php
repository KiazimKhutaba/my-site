<?php

use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';


error_reporting(E_ALL);

/**
 * debug functions
 */
function dump($var) {
    print "<pre>";
    var_dump($var);
    print "</pre>";
}


function debug($var) {
    $d = print_r($var,1);
    print("<pre>{$d}</pre>");
}
/** debug functions */


/** main application loop */
$app = new Castels\Application();
$response = $app->handle(Request::createFromGlobals());
$response->send();


# print sprintf("<pre>%s</pre>\n",print_r(Request::createFromGlobals(),1));