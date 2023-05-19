<?php declare(strict_types=1);

namespace ArticlesApp\Controllers;

use ArticlesApp\Core\View;
use ArticlesApp\Exceptions\ResourceNotFoundException;
use ArticlesApp\Services\Article\IndexArticleService;
use ArticlesApp\Services\Article\Show\ShowArticleServiceRequest;
use ArticlesApp\Services\Article\Show\ShowArticleService;
use RuntimeException;

class ArticleController
{
    public function home(): View
    {
        try {
            $count = 6;
            $articleId = 1;
            $service = new ShowArticleService();
            $singleResponse = $service->execute(new ShowArticleServiceRequest($articleId));

            $articles = [];
            $start = 2;
            for ($i = $start; $i < ($start + $count); $i++) {
                $response = $service->execute(new ShowArticleServiceRequest($i));
                $articles[] = $response->getArticle();
            }

            return new View('index', [
                'first' => $singleResponse->getArticle(),
                'articles' => $articles
            ]);

        } catch (RuntimeException $exception) {

        }
    }

    public function index(): View
    {
        $service = new IndexArticleService();
        $articles = $service->execute();

        return new View('articles', [
            'articles' => $articles
        ]);
    }

    public function show(): View
    {
        try {
            $articleId = (int)$_GET['articleId'];
            $service = new ShowArticleService();
            $response = $service->execute(new ShowArticleServiceRequest($articleId));

            return new View('article', [
                'article' => $response->getArticle(),
                'comments' => $response->getComments()
            ]);
        } catch (ResourceNotFoundException $exception) {

        }
    }
}