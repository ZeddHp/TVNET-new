<?php declare(strict_types=1);

namespace ArticlesApp\Controllers;

use ArticlesApp\ApiClient;
use ArticlesApp\Core\View;

class ArticleController
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function index(): View
    {
        $count = 5;
        $first = $this->client->fetchSingleArticle(1);
        $comments = $this->client->fetchComments(1);
        $articles = [];
        $start = 2;
        for ($i = $start; $i <= ($start + $count); $i++) {
            $articles[] = $this->client->fetchSingleArticle($i);
        }

        return new View('index', [
            'first' => $first,
            'comments' => $comments,
            'articles' => $articles
        ]);
    }

    public function articles(): View
    {
        $articles = $this->client->fetchAllArticles();

        return new View('articles', [
            'articles' => $articles
        ]);
    }

    public function single(): View
    {
        $id = (int)$_GET['articleId'];

        $article = $this->client->fetchSingleArticle($id);
        $comments = $this->client->fetchComments($id);

        return new View('article', [
            'article' => $article,
            'comments' => $comments
        ]);
    }
}