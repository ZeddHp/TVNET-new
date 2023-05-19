<?php  declare(strict_types=1);

namespace ArticlesApp\Services\Author\Show;

class ShowAuthorServiceRequest
{
    private int $authorId;

    public function __construct(int $authorId)
    {
        $this->authorId = $authorId;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }
}