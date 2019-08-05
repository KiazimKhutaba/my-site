<?php


namespace Castels\Controllers\Rebuilding;


use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class RebuildingController extends Controller
{
    /**
     * @Route(
     *   url="/reb",
     *   handler="index"
     * )
     */
    public function index()
    {
        $twig = $this -> get("twig");

        return new Response($twig -> render(
            "rebuilding/rebuilding.html.twig"
        ));
    }
}