<?php


namespace Castels;


use Castels\Controllers\HttpErrorController;
use Castels\Core\Controller;
use Castels\Core\Exceptions\ResourceNotFoundException;
use Castels\Core\Routing\AnnotatedClassLoader;
use Castels\Core\Routing\RouteCollector;
use Castels\Core\Routing\Router;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Exception;
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;


class Application
{
    private $container;


    /**
     * Application constructor.
     */
    public function __construct()
    {
        // global exception handler
        set_exception_handler([$this, 'exceptionHandler']);

        // need for annotation autoloading
        AnnotationRegistry::registerLoader('class_exists');

        // register needed services
        $this->registerServices();

    }

    public function registerServices()
    {
        $services = require_once '../config/services.php';
        $this->container = new Container($services);

        // global app instance
        $this->container['app'] = $this;
    }


    /**
     * @param Request $request
     * @return mixed
     * @throws ResourceNotFoundException
     */
    public function handle(Request $request)
    {
        $classes = $this->getAnnotatedControllers();
        $routes = $this->getRoutes($classes);

        $router = new Router();
        $router->addRoutes($routes);

        $route = $router->match($request->getPathInfo());
        //debug($route);

        list($controller, $method) = explode("::", $route->handler);


        // if(isset($route->before)) {
        //     $middlewares = $route->before;
        //     foreach( $middlewares as $middleware ) {
        //         new $middleware();
        //     }
        // }

        /** @var Controller $obj */
        $obj = new $controller();
        $obj->setContainer($this->container);

        $response = call_user_func_array([$obj, $method], $route->params);

        return $response;

    }

    /**
     * Load annotated controllers
     *
     * @return array|false
     */
    public function getAnnotatedControllers()
    {
        $loader = new AnnotatedClassLoader();
        return $loader->load(Config::AppControllers, Config::ControllersNSPrefix);
    }

    /**
     * Load routes from controllers
     *
     * @param $classes
     * @return array
     */
    public function getRoutes($classes)
    {
        $collector = new RouteCollector();
        return $collector->collectAll($classes);
    }

    /**
     * Global exception handler
     *
     * @param Exception $e
     */
    public function exceptionHandler($e)
    {
        $error = new HttpErrorController();
        $error->setContainer($this->container);
        $response = '';

        if ($e instanceof ResourceNotFoundException) {
            $response = $error->error404();
        } else if ($e instanceof Exception) {
            $response = $error->error500($e);
        } else {
            $response = $error->error500($e);
        }

        $response->send();
    }

}