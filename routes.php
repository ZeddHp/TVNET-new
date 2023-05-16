<?php declare(strict_types=1);

use ArticlesApp\Controllers\ArticleController;
use ArticlesApp\Controllers\AuthorController;

return [
    ['GET', '/', [ArticleController::class, 'index']],
    ['GET', '/articles', [ArticleController::class, 'articles']],
    ['GET', '/article', [ArticleController::class, 'single']],
    ['GET', '/authors', [AuthorController::class, 'authors']],
    ['GET', '/author', [AuthorController::class, 'single']]
];