<?php


namespace Castels\Controllers;

use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @Route(
 *   url = "/page"
 * )
 */
class PageController extends Controller
{

    /**
     * @Route(
     *   handler = "index",
     *   methods = {"GET"}
     * )
     */
    public function index()
    {
        $twig = $this->container['twig'];

        $content = $twig->render('page/index.html.twig.twig', [
            'name' => 'Kiazim Khutaba',
            'title' => 'Main page!'
        ]);

        return new Response($content);
    }


    /**
     * @Route(
     *   url = "/login|/comp",
     *   handler = "login",
     *   methods = {"GET"}
     * )
     */
    public function login()
    {
        print __METHOD__;
    }


    /**
     * @Route(
     *   url = "/article/(\d+)",
     *   handler = "article",
     *   methods = {"GET"}
     * )
     */
    public function article($id)
    {
        $twig = $this->container['twig'];

        $content = $twig->render("page/article.html.twig", [
            "title" => "Просто обычная статья",
            "content" => "Здесь просто <b>обычный текст</b>. Идентификатор статьи {$id}"
        ]);

        return new Response($content);
    }


    /**
     * @Route(
     *   url = "/company/(\w+)/article/(\d+)",
     *   handler = "companyPost",
     *   methods = {"GET"}
     * )
     */
    public function companyPost($company, $articleId)
    {
        print __METHOD__ . " {$company}/{$articleId}";
    }


    /**
     * @Route(
     *   url = "/store/([A-Za-z0-9\.]+)",
     *   handler = "store",
     *   methods = {"GET"}
     * )
     */
    public function store($name)
    {
        return new Response($this->get("twig")->render(
            "page/store.html.twig",
            ["storeName" => $name]
        ));
    }

}