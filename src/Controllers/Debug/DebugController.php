<?php


namespace Castels\Controllers\Debug;


use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class DebugController
 * @package Castels\Controllers\Debug
 *
 * @Route(
 *   url="/debug"
 * )
 */
class DebugController extends Controller
{
    /**
     * @Route(
     *     handler="index"
     * )
     */
    public function index()
    {
        $twig = $this->get("twig");
        $app = $this->get("app");

        $routes = $app->getRoutes($app->getAnnotatedControllers());

        return new Response($twig->render("debug/index.html.twig", [
            "routes" => $routes
        ]));
    }
}