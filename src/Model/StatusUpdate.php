<?php

namespace Model;

use DateTimeImmutable;

/**
 * @Entity(repositoryClass="Repository\StatusUpdateRepository")
 * @Table(name="`Update`")
 */
class StatusUpdate
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
    private $incidentId;

    /**
     * @Column(type="string")
     * @var string
     */
    private $updateId;

    /**
     * @Column(type="string")
     * @var string
     */
    private $regionSlug;

    /**
     * @Column(type="string")
     * @var string
     */
    private $regionName;

    /**
     * @Column(type="string")
     * @var string
     */
    private $serviceName;

    /**
     * @Column(type="string")
     * @var string
     */
    private $serviceStatus;


    /**
     * @Column(type="string", nullable=true)
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
        string $incidentId,
        string $updateId,
        string $regionSlug,
        string $regionName,
        string $serviceName,
        string $serviceStatus,
        ?string $author,
        string $content,
        string $severity,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updateAt
    ) {
        $this->incidentId = $incidentId;
        $this->updateId = $updateId;
        $this->regionSlug = $regionSlug;
        $this->regionName = $regionName;
        $this->serviceName = $serviceName;
        $this->serviceStatus = $serviceStatus;
        $this->author = $author;
        $this->content = $content;
        $this->severity = $severity;
        $this->createdAt = $createdAt;
        $this->updateAt = $updateAt;
    }
}
