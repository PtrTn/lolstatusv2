<?php

namespace Repository;

use Doctrine\ORM\EntityManager;
use Model\Incident;
use Webmozart\Assert\Assert;

class IncidentRepository
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Incident[] $incidents
     */
    public function saveMultiple(array $incidents) : void
    {
        Assert::allIsInstanceOf($incidents, Incident::class);
        foreach ($incidents as $incident) {
            $this->entityManager->persist($incident);
        }
        $this->entityManager->flush();
        return;
    }
}
