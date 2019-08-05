<?php


namespace Castels\Controllers\Admin;

use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MainController
 * @package Castels\Controllers\Admin
 *
 * @Route(
 *  url="/admin"
 * )
 */
class MainController extends Controller
{
    /**
     * @Route(
     *   handler="index"
     * )
     */
    public function index()
    {
        return new Response("Hello, Admin");
    }

}