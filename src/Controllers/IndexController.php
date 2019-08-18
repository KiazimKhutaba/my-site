<?php

namespace Castels\Controllers;

use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
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
     *
     * @Route(
     *     url="/",
     *     handler="index"
     * )
     */
    public function index()
    {
        return $this->render('index/main_page.html.twig');
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
        $response = $this->render(
            "index/articles.html.twig",
            ["number" => rand(0, PHP_INT_MAX)]
        );

        return $response;
    }

    /**
     *
     * @Route(
     *     url="/article/(\d+)",
     *     handler="article"
     * )
     * @param int $id article id
     * @return Response
     */
    public function article($id)
    {
        return $this->render("index/article.html.twig", ["id" => $id]);
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
        return $this->render("index/contact.html.twig");
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
        return $this->render("index/about.html.twig");
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
        return $this->render("index/search.html.twig");
    }


}