<?php declare(strict_types=1);

namespace ArticlesApp;

use ArticlesApp\Models\Article;
use ArticlesApp\Models\Comment;
use ArticlesApp\Models\Author;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

class ApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['verify' => false]);
    }

    public function fetchAuthors(): array
    {
        try {
            if (!Cache::has('authors')) {
                $response = $this->client->get('https://jsonplaceholder.typicode.com/users');
                $responseJson = $response->getBody()->getContents();
                Cache::save('authors', $responseJson);
            } else {
                $responseJson = Cache::get('authors');
            }

            $authorContent = json_decode($responseJson);
            return $this->createAuthorsCollection((array)$authorContent);

        } catch (GuzzleException $exception) {
            return [];
        }
    }

    public function fetchSingleAuthor(int $id): ?Author
    {
        try {
            if (!Cache::has('author_' . $id)) {
                $response = $this->client->get("https://jsonplaceholder.typicode.com/users/$id");
                $responseJson = $response->getBody()->getContents();
                Cache::save('author_' . $id, $responseJson);
            } else {
                $responseJson = Cache::get('author_' . $id);
            }

            $authorContent = json_decode($responseJson);
            return $this->createAuthor($authorContent);

        } catch (GuzzleException $exception) {
            return null;
        }
    }

    public function fetchAllArticles(): array
    {
        try {
            if (!Cache::has('articles')) {
                $response = $this->client->get("https://jsonplaceholder.typicode.com/posts");
                $responseJson = $response->getBody()->getContents();
                Cache::save('articles', $responseJson);
            } else {
                $responseJson = Cache::get('articles');
            }

            $articlesContent = json_decode($responseJson);
            return $this->createArticlesCollection($articlesContent);

        } catch (GuzzleException $exception) {
            return [];
        }
    }

    public function fetchArticlesByAuthorId(int $authorId): array
    {
        try {
            if (!Cache::has('articles_author_' . $authorId)) {
                $response = $this->client->get("https://jsonplaceholder.typicode.com/users/$authorId/posts");
                $responseJson = $response->getBody()->getContents();
                Cache::save('articles_author_' . $authorId, $responseJson);
            } else {
                $responseJson = Cache::get('articles_author_' . $authorId);
            }

            $articlesContent = json_decode($responseJson);
            return $this->createArticlesCollection($articlesContent);

        } catch (GuzzleException $exception) {
            return [];
        }
    }

    public function fetchSingleArticle(int $id): ?Article
    {
        try {
            if (!Cache::has('article_' . $id)) {
                $response = $this->client->get("https://jsonplaceholder.typicode.com/posts/$id");
                $responseJson = $response->getBody()->getContents();
                Cache::save('article_' . $id, $responseJson);
            } else {
                $responseJson = Cache::get('article_' . $id);
            }

            $articleContent = json_decode($responseJson);
            return $this->createArticle($articleContent);

        } catch (GuzzleException $exception) {
            return null;
        }
    }

    public function fetchComments(int $articleId): array
    {
        try {
            if (!Cache::has('article_comments_' . $articleId)) {
                $response = $this->client->get("https://jsonplaceholder.typicode.com/posts/$articleId/comments");
                $responseJson = $response->getBody()->getContents();
                Cache::save('article_comments_' . $articleId, $responseJson);
            } else {
                $responseJson = Cache::get('article_comments_' . $articleId);
            }

            $commentsContent = json_decode($responseJson);
            return $this->createCommentsCollection($commentsContent);

        } catch (GuzzleException $exception) {
            return [];
        }
    }

    public function createAuthorsCollection(array $authors): array
    {
        $collection = [];
        foreach ($authors as $author) {
            $collection[] = $this->createAuthor($author);
        }
        return $collection;
    }

    public function createArticlesCollection(array $articles): array
    {
        $collection = [];
        foreach ($articles as $article) {
            $collection[] = $this->createArticle($article);
        }
        return $collection;
    }

    public function createCommentsCollection(array $comments): array
    {
        $collection = [];
        foreach ($comments as $comment) {
            $collection[] = $this->createComment($comment);
        }
        return $collection;
    }

    public function createAuthor(stdClass $authorContent): Author
    {
        return new Author(
            $authorContent->id,
            $authorContent->name,
            $authorContent->username,
            $authorContent->email,
            $authorContent->website,
            $authorContent->address->city,
            $authorContent->company->name
        );
    }

    public function createArticle(stdClass $articleContent): Article
    {
        return new Article(
            $articleContent->id,
            $articleContent->title,
            $articleContent->body,
            $this->fetchSingleAuthor($articleContent->userId)
        );
    }

    public function createComment(stdClass $commentContent): Comment
    {
        return new Comment(
            $commentContent->postId,
            $commentContent->id,
            $commentContent->name,
            $commentContent->email,
            $commentContent->body
        );
    }
}