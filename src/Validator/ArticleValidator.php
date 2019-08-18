<?php


namespace Castels\Validator;


use Castels\Core\Validator;
use Castels\Entity\ArticleEntity;

class ArticleValidator extends Validator
{

    /**
     * @var ArticleEntity
     */
    private $article;

    public function __construct(ArticleEntity $article)
    {
        $this->article = $article;
    }


    /**
     * @return array
     */
    public function validate(): array
    {
        $article = $this->article;

        if (!$article)
            $this->addError("Задан пустой запрос!");

        if (!$article->title) {
            $this->addError("У статьи должно быть название!");
        }

        $titleLen = mb_strlen($article->title);
        if ($titleLen < 10 OR $titleLen > 100)
            $this->addError("Длина заголовка статьи не может быть меньше 10 или больше 100 символов!");


        $urlLen = mb_strlen($article->url);
        if ($urlLen < 5 or $urlLen > 100)
            $this->addError("Длина URL адреса должна быть больше 5 и меньше 100 символов!");

        $urlAlreadyExist = $this->model->getURL($article->url);
        if ($urlAlreadyExist)
            $this->addError("Такой URL уже есть в базе! Придумайте другой!");


        if (!preg_match('/[A-Za-z+\-]+/', $article->url))
            $this->addError("URL адрес должен состоять из латинских букв и тире!");

        $authorLen = mb_strlen($article->author);
        if ($authorLen < 5 or $authorLen > 50)
            $this->addError("Длина поле автора должна быть  больше 5 и меньше 50 симолов!");


        $textLen = mb_strlen($article->content);
        if ($textLen < 5)
            $this->addError("Смысл публиковать пустую статью?! Введите хотя бы 5 символов!");

        return $this->errors;
    }

}