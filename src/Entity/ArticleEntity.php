<?php


namespace Castels\Entity;


use Castels\Core\Entity;

class ArticleEntity extends Entity
{
    /** @var int */
    public $id;

    /** @var int */
    public $publishedAt;

    /** @var string */
    public $title;

    /** @var string */
    public $url;

    /** @var string */
    public $author;

    /** @var string */
    public $content;

    /** @var string */
    public $category;
}