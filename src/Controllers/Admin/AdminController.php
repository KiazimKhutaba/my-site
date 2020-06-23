<?php


namespace Castels\Controllers\Admin;

use Castels\Core\Controller;
use Castels\Core\Routing\Annotation\Route;
use Castels\Model\ArticleModel;
use Castels\Validator\ArticleValidator;
use PDO;

/**
 * Class MainController
 * @package Castels\Controllers\Admin
 *
 * @Route(
 *  url="/admin",
 *  before={"Middleware\Auth"}
 * )
 */
class AdminController extends Controller
{

    // public function __construct()
    // {
    //     if( !isset($_COOKIE['login33']) ) {
    //         header('Location: /login');
    //     }
    // }

    /**
     * @Route(
     *   handler="index"
     * )
     */
    public function index()
    {
        return $this->render("admin/index.html.twig");
    }


    /**
     * @Route(
     *   url="/articles/show",
     *   handler="showArticles"
     * )
     */
    public function showArticles()
    {
        /** @var PDO $pdo */
        $pdo = $this->get('pdo');
        $sql = "SELECT id, url, title FROM articles WHERE LENGTH(title) > 0 ORDER BY publishedAt DESC";
        $articles = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);


        return $this->render("admin/articles_list.html.twig", ["articles" => $articles]);
    }


    /**
     * @Route(
     *   url="/articles/add",
     *   handler="addArticle"
     * )
     */
    public function addArticle()
    {
        $data = [];

        if (isset($_REQUEST['publish'])) {

            /** @var PDO $db */
            $db = $this->get('pdo');
            $articleModel = new ArticleModel($db);
            $article = $articleModel->makeArticle($_REQUEST);


            $validator = new ArticleValidator($article);
            $validator->setModel($articleModel);
            $errors = $validator->validate();
            
            if ($errors) {
                $data["errors"] = $errors;
                return $this->render("admin/add_post.html.twig", $data);
            }


            $queryResult = $articleModel->create($article);

            if ($queryResult) {
                $data["result"] = $queryResult;
                $this->render("admin/add_post.html.twig", $data);
            }

        }

        return $this->render("admin/add_post.html.twig", $data);
    }


}