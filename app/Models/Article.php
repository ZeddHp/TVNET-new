<?php declare(strict_types=1);

namespace ArticlesApp\Models;

class Article
{
    private int $id;
    private string $title;
    private string $content;
    private Author $author;

    public function __construct
    (
        int    $id,
        string $title,
        string $content,
        Author $author
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function author(): Author
    {
        return $this->author;
    }
}