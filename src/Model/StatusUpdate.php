<?php

namespace Model;

use DateTimeImmutable;

/**
 * @Entity(repositoryClass="Repository\StatusUpdateRepository")
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIncidentId(): string
    {
        return $this->incidentId;
    }

    /**
     * @return string
     */
    public function getUpdateId(): string
    {
        return $this->updateId;
    }

    /**
     * @return string
     */
    public function getRegionSlug(): string
    {
        return $this->regionSlug;
    }

    /**
     * @return string
     */
    public function getRegionName(): string
    {
        return $this->regionName;
    }

    /**
     * @return string
     */
    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    /**
     * @return string
     */
    public function getServiceStatus(): string
    {
        return $this->serviceStatus;
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
