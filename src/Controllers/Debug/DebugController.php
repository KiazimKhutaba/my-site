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
 *   url="/debug",
 *   before={"\Castels\Middleware\Auth"}
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
        $app  = $this->get("app");

        $routes = $app->getRoutes($app->getAnnotatedControllers());

        return new Response($twig->render("debug/index.html.twig", [
            "routes" => $routes
        ]));
    }


    /**
     * @Route(
     *  url="/system/info",
     *  handler="systemInfo"
     * )
     */
    public static function systemInfo()
    {
        $content = sprintf("<pre>%s</pre>", print_r(get_included_files(), true));
        return new Response($content);
    }

    /**
     * @Route(
     *  url="/routes",
     *  handler="routes"
     * )
     */
    public function routes()
    {
        $app = $this->get("app");
        $routes = $app->getRoutes($app->getAnnotatedControllers());

        ob_start();
        array_walk(
            $routes,
            function($e) {
                print $e . "<br/>";
            }
        );
        $content = \ob_get_clean();

        return new Response($content);
    }


}
