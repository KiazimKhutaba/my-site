<?php


namespace Castels\Controllers;


use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class HttpErrorController extends Controller
{
    /**
     * @Route(
     *     url="/error404",
     *     handler="error404"
     * )
     *
     * @return Response
     */
    public function error404()
    {
        $twig = $this->get("twig");
        $page = Request::createFromGlobals()->getRequestUri();

        $response = new Response($twig->render(
            "error/404.html.twig",
            ["page" => $page]
        ),
            Response::HTTP_NOT_FOUND
        );

        return $response;
    }


    /**
     * @Route(
     *     url="/error403",
     *     handler="error403"
     * )
     *
     * @return Response
     */
    public function error403()
    {
        $twig = $this->get("twig");

        $response = new Response($twig->render(
            "error/403.html.twig"
        ),
            Response::HTTP_FORBIDDEN
        );

        return $response;
    }

    /**
     * @Route(
     *     url="/error500",
     *     handler="error500"
     * )
     *
     * @param Exception $e
     * @return Response
     */
    public function error500($e)
    {
        $twig = $this->get("twig");

        $response = new Response($twig->render(
            "error/500.html.twig", ["message" => $e]
        ),
            Response::HTTP_SERVICE_UNAVAILABLE
        );

        return $response;
    }


    /**
     * @Route(
     *     url="/long/args/(\w+)/(\d+)/(\d+)/(\d+)/([\w\-]+)",
     *     handler="veryLongArgs"
     * )
     */
    public function veryLongArgs($company, $year, $month, $day, $url)
    {
        return new Response(
            sprintf("Co: %s, %d/%d/%d. Url: %s", $company, $year, $month, $day, $url)
        );
    }
}