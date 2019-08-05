<?php


namespace Castels;


use Castels\Controllers\HttpErrorController;
use Castels\Core\Exceptions\ResourceNotFoundException;
use Castels\Core\Routing\Annotation\Route;
use Castels\Core\Routing\FileLoader;
use Castels\Core\Routing\RouteCollector;
use Castels\Core\Routing\Router;
use Exception;
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class Application
{
    private $container;


    /**
     * Application constructor.
     */
    public function __construct()
    {
        new Route(); // for annotation autoloading
        $this->container = new Container();
        $this->container["app"] = $this;
        $this->setUp();
        //set_exception_handler([Application::class,'exceptionHandler']);
    }

    public function setUp()
    {

        $this->container['twig'] = function () {

            $loader = new FilesystemLoader(Config::AppViews);
            $twig = new Environment($loader,
                ['cache' => false]
            /*['cache' => __DIR__ . '/../cache']*/
            );

            return $twig;
        };

        return $this;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request)
    {
        $error = new HttpErrorController();
        $error->setContainer($this->container);

        try {
            $classes = $this->getAnnotatedControllers();
            $routes = $this->getRoutes($classes);

            $router = new Router();
            $router->addRoutes($routes);

            $route = $router->match($request->getPathInfo());

            list($controller, $method) = explode("::", $route->handler);

            $obj = new $controller();
            $obj->setContainer($this->container);

            $response = call_user_func_array([$obj, $method], $route->params);

            return $response;

        } 
		catch (ResourceNotFoundException $e) {
            return $error->error404();
        } 
		catch (Exception $e) {
            return $error->error500($e);
        }

    }

    public function getAnnotatedControllers()
    {
        $loader = new FileLoader();
        return $loader->load(Config::AppControllers, Config::ControllersNSPrefix);
    }

    public function getRoutes($classes)
    {
        $collector = new RouteCollector();
        return $collector->collectAll($classes);
    }

    public function exceptionHandler($e)
    {
    }

    public function run()
    {
        /*if (file_exists("cache/routes.txt")) {
            $routes = unserialize(file_get_contents("cache/routes.txt"));
        } else {
            // собираем маршруты с класса
            $routes = $collector->collectAll($classes);
            file_put_contents("cache/routes.txt", serialize($routes));
        }*/

        //debug($routes);

    }
}