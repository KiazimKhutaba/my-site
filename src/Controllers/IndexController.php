<?php

namespace Castels\Controllers;

use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IndexController
 *
 * @Route(
 *     methods={"GET","POST"}
 * )
 */
class IndexController extends Controller
{
    /**
     *
     * @Route(
     *     url="/",
     *     handler="index"
     * )
     */
    public function index()
    {
        $twig = $this->get("twig");

        $response = new Response($twig->render(
            "index/main_page.html.twig"
        ));

        return $response;
    }

    /**
     *
     * @Route(
     *     url="/articles",
     *     handler="articles"
     * )
     */
    public function articles()
    {
        $twig = $this->get("twig");

        $response = new Response($twig->render(
            "index/articles.html.twig",
            ["number" => rand(0, PHP_INT_MAX)]
        ));

        return $response;
    }


    /**
     *
     * @Route(
     *     url="/article/(\d+)",
     *     handler="article"
     * )
     */
    public function article($id)
    {
        $twig = $this->get("twig");

        $response = new Response($twig->render(
            "index/article.html.twig",
            ["id" => $id]
        ));

        return $response;
    }


    /**
     *
     * @Route(
     *     url="/contact",
     *     handler="contact"
     * )
     */
    public function contact()
    {
        $twig = $this->get("twig");

        $response = new Response($twig->render(
            "index/contact.html.twig"
        ));

        return $response;
    }

    /**
     *
     * @Route(
     *     url="/about",
     *     handler="about"
     * )
     */
    public function about()
    {
        $twig = $this->get("twig");

        $response = new Response($twig->render(
            "index/about.html.twig"
        ));

        return $response;
    }

    /**
     *
     * @Route(
     *     url="/search",
     *     handler="search"
     * )
     */
    public function search()
    {
        $twig = $this->get("twig");

        $response = new Response($twig->render(
            "index/search.html.twig"
        ));

        return $response;
    }



    /**
     * @Route(
     *  url="/system/info",
     *  handler="systemInfo"
     * )
     */
    public static function systemInfo()
    {
		$content = sprintf("<pre>%s</pre>",print_r(get_included_files(), true));
		
        return new Response($content);
    }


}