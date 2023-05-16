<?php declare(strict_types=1);

namespace ArticlesApp\Models;

class Author
{
    private int $id;
    private string $name;
    private string $userName;
    private string $eMail;
    private string $website;
    private string $homeTown;
    private string $workingPlace;

    public function __construct
    (
        int    $id,
        string $name,
        string $userName,
        string $eMail,
        string $website,
        string $homeTown,
        string $workingPlace
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->userName = $userName;
        $this->eMail = $eMail;
        $this->website = $website;
        $this->homeTown = $homeTown;
        $this->workingPlace = $workingPlace;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function eMail(): string
    {
        return $this->eMail;
    }

    public function website(): string
    {
        return $this->website;
    }

    public function homeTown(): string
    {
        return $this->homeTown;
    }

    public function workingPlace(): string
    {
        return $this->workingPlace;
    }
}