<?php declare(strict_types=1);

namespace ArticlesApp\Services\Article;

use ArticlesApp\ApiClient;

class IndexAuthorService
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function execute(): array
    {
        return $this->client->fetchAuthors();
    }
}