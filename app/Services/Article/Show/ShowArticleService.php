<?php declare(strict_types=1);

namespace ArticlesApp\Services\Article\Show;

use ArticlesApp\ApiClient;
use ArticlesApp\Exceptions\ResourceNotFoundException;

class ShowArticleService
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function execute(ShowArticleServiceRequest $request): ShowArticleServiceResponse
    {
        $article = $this->client->fetchSingleArticle($request->getArticleId());

        if ($article == null) {
            throw new ResourceNotFoundException('Article by id ' . $request->getArticleId() . ' not found');
        }

        $comments = $this->client->fetchCommentsByArticleId($request->getArticleId());

        return new ShowArticleServiceResponse($article, $comments);
    }
}