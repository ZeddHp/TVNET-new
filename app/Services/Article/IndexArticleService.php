<?php declare(strict_types=1);

use ArticlesApp\Services\Article;

class IndexArticleService
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function execute(): array
    {
        $articles = $this->client->fetchAllArticles();
        return $this->createArticlesCollection($articles);//
    }


}