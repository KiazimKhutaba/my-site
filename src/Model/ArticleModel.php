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
        $this->trim($article);

        $article->url = $request['url'] ?? '';
        $article->title = $request['title'] ?? '';
        $article->author = $request['author'] ?? '';
        $article->content = $request['text'] ?? '';

        return $article;
    }

    /**
     * Clean and trim article props
     *
     * @param ArticleEntity $article
     * @return array
     */
    public function trim(ArticleEntity &$article)
    {
        foreach ($article as $propName => $propValue)
            $article->{$propName} = trim($propValue);
    }

    public function create(ArticleEntity $article)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO articles (url,title,author,content) VALUES (:url,:title,:author,:content)");

        $result = $stmt->execute([
            'url' => $article->url,
            'title' => $article->title,
            'author' => $article->author,
            'content' => $article->content
        ]);


        return $result;

    }

    public function getURL(string $url)
    {
        $sql = "SELECT id FROM articles WHERE url = :url";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['url' => $url]);

        $r = $stmt->fetchAll();
        //$r = $this->pdo->query($sql) -> fetchAll();

        return $r;
    }

}