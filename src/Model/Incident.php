<?php

namespace Model;

use DateTimeImmutable;

/**
 * @Entity
 * @ORM\Entity(repositoryClass="Repository\IncidentRepository")
 */
class Incident
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
    private $region;

    /**
     * @Column(type="string")
     * @var string
     */
    private $service;

    /**
     * @Column(type="string")
     * @var string
     */
    private $serviceStatus;

    /**
     * @Column(type="boolean")
     * @var bool
     */
    private $active;

    /**
     * @Column(type="datetime")
     * @var DateTimeImmutable
     */
    private $createdAt;

    /**
     * @ManyToMany(targetEntity="Update", cascade={"persist"})
     * @JoinTable(name="incident_updates",
     *      joinColumns={@JoinColumn(name="incident_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="update_id", referencedColumnName="id")}
     *      )
     * @var Update[]
     */
    private $updates;

    public function __construct(
        string $id,
        string $region,
        string $service,
        string $serviceStatus,
        bool $active,
        DateTimeImmutable $createdAt,
        array $updates
    ) {
        $this->incidentId = $id;
        $this->region = $region;
        $this->service = $service;
        $this->serviceStatus = $serviceStatus;
        $this->active = $active;
        $this->createdAt = $createdAt;
        $this->updates = $updates;
    }
}
