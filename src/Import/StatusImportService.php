<?php

namespace Import;

use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Event\NewIncidentEvent;
use Event\UpdatedIncidentEvent;
use Model\Incident;
use Model\Region;
use Model\Update;
use Repository\IncidentRepository;
use Symfony\Component\EventDispatcher\EventDispatcher;

class StatusImportService
{
    /**
     * @var StatusImportClient
     */
    private $importClient;

    /**
     * @var IncidentRepository
     */
    private $incidentRepository;

    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    public function __construct(
        StatusImportClient $importClient,
        EntityManager $entityManager,
        EventDispatcher $eventDispatcher
    ) {
        $this->importClient = $importClient;
        $this->incidentRepository = $entityManager->getRepository(Incident::class);
        $this->eventDispatcher = $eventDispatcher;
    }

    public function checkForNewOrUpdatedIncidentsInRegion(Region $region) : void
    {
        $incidents = $this->getCurrentIncidentsForRegion($region);
        foreach ($incidents as $incident) {
            $existingIncident = $this->incidentRepository->findIncident($incident);
            if (!isset($existingIncident)) {
                $event = new NewIncidentEvent($incident);
                $this->eventDispatcher->dispatch('incident.new', $event);
                continue;
            }
            if (!$existingIncident->haveSameUpdates($incident)) {
                $event = new UpdatedIncidentEvent($existingIncident, $incident);
                $this->eventDispatcher->dispatch('incident.update', $event);
            }
        }
        return;
    }

    /**
     * @param Region $region
     * @return Incident[]
     */
    private function getCurrentIncidentsForRegion(Region $region) : array
    {
        $status = $this->importClient->getStatusForRegion($region);
        $incidents = [];
        foreach ($status->services as $service) {
            foreach ($service->incidents as $incident) {
                $updates = [];
                foreach ($incident->updates as $update) {
                    $updates[] = new Update(
                        $update->id,
                        !empty($update->author) ? $update->author: null,
                        $update->content,
                        $update->severity,
                        new DateTimeImmutable($update->created_at),
                        new DateTimeImmutable($update->updated_at)
                    );
                }
                $incidents[] = new Incident(
                    $incident->id,
                    $status->slug,
                    $service->slug,
                    $service->status,
                    $incident->active,
                    new DateTimeImmutable($incident->created_at),
                    $updates
                );
            }
        }
        return $incidents;
    }
}
