<?php

namespace Model;

use DateTime;

class Update
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var null|string
     */
    private $author;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $severity;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $updateAt;

    public function __construct(
        string $id,
        ?string $author,
        string $content,
        string $severity,
        DateTime $createdAt,
        DateTime $updateAt
    ) {
        $this->id = $id;
        $this->author = $author;
        $this->content = $content;
        $this->severity = $severity;
        $this->createdAt = $createdAt;
        $this->updateAt = $updateAt;
    }
}
