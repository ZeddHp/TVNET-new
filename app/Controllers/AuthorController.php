<?php declare(strict_types=1);

namespace ArticlesApp\Controllers;


use ArticlesApp\Core\View;

use ArticlesApp\Exceptions\ResourceNotFoundException;

use ArticlesApp\Services\Article\IndexAuthorService;

use ArticlesApp\Services\Author\Show\ShowAuthorService;

use ArticlesApp\Services\Author\Show\ShowAuthorServiceRequest;


class AuthorController

{

    public function index(): View


    {

        $service = new IndexAuthorService();

        $authors = $service->execute();


        return new View('authors', [

            'authors' => $authors

        ]);

    }


    public function show(): View

    {

        try {

            $authorId = (int)$_GET['authorId'];

            $service = new ShowAuthorService();

            $response = $service->execute(new ShowAuthorServiceRequest($authorId));


            return new View('author', [

                'author' => $response->getAuthor(),

                'articles' => $response->getArticles()

            ]);

        } catch (ResourceNotFoundException $exception) {


        }

    }

}