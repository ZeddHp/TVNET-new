<?php declare(strict_types=1);

namespace ArticlesApp\Services\Article\Show;

use ArticlesApp\Models\Article;

class ShowArticleServiceResponse
{
    private Article $article;
    private array $comments;

    public function __construct(Article $article, array $comments)
    {
        $this->article = $article;
        $this->comments = $comments;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function getComments(): array
    {
        return $this->comments;
    }
}