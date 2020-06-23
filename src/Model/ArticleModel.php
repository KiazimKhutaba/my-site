<?php


namespace Castels\Model;


use Castels\Core\BaseModel;
use Castels\Entity\ArticleEntity;
use PDO;

class ArticleModel extends BaseModel
{

    /**
     * @var PDO
     */
    private $pdo;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function makeArticle(array $request)
    {
        $article = new ArticleEntity();
        //$this->trim($article);

        $article->url      = $request['url']      ?? '';
        $article->title    = $request['title']    ?? '';
        $article->author   = $request['author']   ?? '';
        $article->content  = $request['text']     ?? '';
        $article->category = $request['category'] ?? '';

        return $article;
    }


    public function create(ArticleEntity $article)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO 
                articles (url,title,author,content,category_name) 
             VALUES (:url,:title,:author,:content,:category_name)");

        $result = $stmt->execute([
            'url' => $article->url,
            'title' => $article->title,
            'author' => $article->author,
            'content' => $article->content,
            'category_name' => $article->category
        ]);


        return $result;

    }

    /**
     * Check if article with given url already exists in database
     */
    public function getURL(string $url)
    {
        $sql = "SELECT id FROM articles WHERE url = :url";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['url' => $url]);

        $r = $stmt->fetchAll();

        return $r;
    }

    /** 
     * Fetch article by name from db
     */
    public function getArticle(string $url)
    {
        $sql  =  "SELECT * FROM articles WHERE url = :url";
        $stmt =  $this->pdo->prepare($sql);
        $stmt -> execute(['url' => $url]);

        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        return $article;
    }


    /**
     * Get all articles
     */
    public function getAll()
    {
        $sql = "SELECT * FROM articles ORDER BY publishedAt DESC";
        $articles = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    }

}