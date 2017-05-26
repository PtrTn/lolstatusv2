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
     * @GeneratedValue
     * @Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @Id
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

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUpdateId()
    {
        return $this->updateId;
    }

    /**
     * @return null|string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getSeverity(): string
    {
        return $this->severity;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdateAt(): DateTimeImmutable
    {
        return $this->updateAt;
    }
}
