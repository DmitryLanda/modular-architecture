<?php

namespace App\News\Domain;

class News
{
    private string $id;
    private string $title;
    private string $body;
    private string $authorId;

    public function __construct(string $title, string $body, string $authorId, ?string $id)
    {
        $this->id = $id ?? 'xxx';
        $this->title = $title;
        $this->body = $body;
        $this->authorId = $authorId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getAuthorId(): string
    {
        return $this->authorId;
    }
}
