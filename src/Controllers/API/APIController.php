<?php

namespace Castels\Controllers\API;

use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class APIController
 *
 * @Route(
 *  url="/api"
 * )
 */
class APIController extends Controller
{
    /**
     * @Route(
     *   url = "/numbers",
     *   handler = "numbers",
     *   methods = {"GET"}
     * )
     */
    public function numbers()
    {
        return new JsonResponse([rand(), rand(), rand()]);
    }


    /**
     *
     * @Route(
     *   url = "/random",
     *   handler = "random",
     *   methods = {"GET"}
     * )
     */
    public function random()
    {
        return new JsonResponse(rand());
    }


    /**
     *
     * @Route(
     *   url = "/add",
     *   handler = "addPost",
     *   methods = {"POST"}
     * )
     */
    public function addPost()
    {
        $request = Request::createFromGlobals();
        $key = $request->query->get("key");

        return new JsonResponse(["key" => $key]);
    }

}