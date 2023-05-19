<?php  declare(strict_types=1);

namespace ArticlesApp\Services\Author\Show;

use ArticlesApp\ApiClient;
use ArticlesApp\Exceptions\ResourceNotFoundException;

class ShowAuthorService
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function execute(ShowAuthorServiceRequest $request): ShowAuthorServiceResponse
    {
        $author = $this->client->fetchSingleAuthor($request->getAuthorId());

        if ($author == null) {
            throw new ResourceNotFoundException('Author by id ' . $request->getAuthorId() . ' not found');
        }

        $articles = $this->client->fetchArticlesByAuthorId($request->getAuthorId());

        return new ShowAuthorServiceResponse($author, $articles);
    }
}