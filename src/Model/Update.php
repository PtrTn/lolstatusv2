<?php

namespace Model;

use DateTimeImmutable;

/**
 * @Entity
 * @Table(name="`Update`")
 */
class Update
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @Column(type="string")
     * @var string
     */
    private $updateId;

    /**
     * @Column(type="string")
     * @var null|string
     */
    private $author;

    /**
     * @Column(type="string")
     * @var string
     */
    private $content;

    /**
     * @Column(type="string")
     * @var string
     */
    private $severity;

    /**
     * @Column(type="datetime")
     * @var DateTimeImmutable
     */
    private $createdAt;

    /**
     * @Column(type="datetime")
     * @var DateTimeImmutable
     */
    private $updateAt;

    public function __construct(
        string $updateId,
        ?string $author,
        string $content,
        string $severity,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updateAt
    ) {
        $this->updateId = $updateId;
        $this->author = $author;
        $this->content = $content;
        $this->severity = $severity;
        $this->createdAt = $createdAt;
        $this->updateAt = $updateAt;
    }
}
