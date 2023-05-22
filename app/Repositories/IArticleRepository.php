<?php

namespace ArticlesApp\Repositories;

use ArticlesApp\Cache;

use RuntimeException;

class IArticleRepository
{
    private const BASE_URI = 'https://jsonplaceholder.typicode.com/';
    private object $client;
    private array $articles;
    private string $requestUri;

    public function __construct(string $requestUri)
    {
        $this->requestUri = $requestUri;
        $this->client = new Client(['base_uri' => self::BASE_URI]);
    }

    public function getPosts(): ?array
    {
        $cacheFileName = Functions::replaceSlash($this->requestUri);

        if (!Cache::has($cacheFileName)) {
            try {
                $response = ($this->client->request('GET', $this->requestUri))->getBody()->getContents();
            } catch (GuzzleException $e) {
                if (!isset($_SERVER['argv'])) {
                    return (new ErrorController())->error();
                }
                if (isset($_SERVER['argv'])) {
                    throw new RuntimeException;
                }
            }
        } else {
            $response = Cache::get($cacheFileName);
        }
        Cache::remember($cacheFileName, $response);
        if ((gettype(json_decode($response))) === 'array') {
            $this->response = json_decode($response);
        }
        if ((gettype(json_decode($response))) === 'object') {
            $this->response = ['0' => json_decode($response)];
        }
        return $this->buildModel($this->response);
    }

    private function buildModel(array $response): array
    {
        $posts = [];
        foreach ($response as $post) {
            $posts[] = new Posts (
                $post->userId,
                $post->id,
                $post->title,
                $post->body,
                '/users/' . $post->userId,
                '/posts/' . $post->id
            );
        }
        return $posts;
    }

}