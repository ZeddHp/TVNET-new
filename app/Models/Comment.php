<?php declare(strict_types=1);

namespace ArticlesApp\Models;

class Comment
{
    private int $postId;
    private int $id;
    private string $title;
    private string $eMail;
    private string $content;

    public function __construct
    (
        int    $postId,
        int    $id,
        string $title,
        string $eMail,
        string $content
    )
    {
        $this->postId = $postId;
        $this->id = $id;
        $this->title = $title;
        $this->eMail = $eMail;
        $this->content = $content;
    }

    public function postId(): int
    {
        return $this->postId;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function eMail(): string
    {
        return $this->eMail;
    }

    public function content(): string
    {
        return $this->content;
    }
}