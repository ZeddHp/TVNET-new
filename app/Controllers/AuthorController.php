<?php declare(strict_types=1);

namespace ArticlesApp\Controllers;

use ArticlesApp\ApiClient;
use ArticlesApp\Core\View;

class AuthorController
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function authors(): View
    {
        $authors = $this->client->fetchAuthors();

        return new View('authors', [
            'authors' => $authors
        ]);
    }

    public function single(): View
    {
        $id = (int)$_GET['authorId'];

        $author = $this->client->fetchSingleAuthor($id);
        $articles = $this->client->fetchArticlesByAuthorId($id);

        return new View('author', [
            'author' => $author,
            'articles' => $articles
        ]);
    }
}