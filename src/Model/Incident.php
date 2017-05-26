<?php

namespace Model;

use DateTime;

class Incident
{
    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $service;

    /**
     * @var string
     */
    private $serviceStatus;

    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var array
     */
    private $updates;

    public function __construct(
        string $region,
        string $service,
        string $serviceStatus,
        string $id,
        bool $active,
        DateTime $createdAt,
        array $updates
    ) {
        $this->region = $region;
        $this->service = $service;
        $this->serviceStatus = $serviceStatus;
        $this->id = $id;
        $this->active = $active;
        $this->createdAt = $createdAt;
        $this->updates = $updates;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @return string
     */
    public function getServiceStatus(): string
    {
        return $this->serviceStatus;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return array
     */
    public function getUpdates(): array
    {
        return $this->updates;
    }
}
