<?php declare(strict_types=1);

namespace ArticlesApp\Services\Author\Show;

use ArticlesApp\Models\Author;

class ShowAuthorServiceResponse
{
    private Author $author;
    private array $articles;

    public function __construct(Author $author, array $articles)
    {
        $this->author = $author;
        $this->articles = $articles;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function getArticles(): array
    {
        return $this->articles;
    }
}