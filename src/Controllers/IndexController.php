<?php

namespace Castels\Controllers;

use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Castels\Model\ArticleModel;



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
        $model = new ArticleModel($this->get("pdo"));
        $posts = $model -> getAll();

        //debug($posts);

        return $this->render('index/main_page.html.twig', [ "posts" => $posts ]);
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
     *     url="/post/([\.\-\w]+)",
     *     handler="post" 
     * )
     */
    public function post($slug)
    {
        $model = new ArticleModel($this->get('pdo'));
        $post = $model -> getArticle($slug);

        //print_r($article);

        if( $post ) {
            return $this->render("index/article.html.twig", [ "post" => $post ]);
        }

        //$this -> get('event_dispatcher') -> trigger(PostEvent::POST_OPENED,new PostEvent($post));

        throw new \Castels\Core\Exceptions\ResourceNotFoundException();
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