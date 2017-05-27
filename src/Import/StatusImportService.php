<?php

namespace Import;

use Doctrine\ORM\EntityManager;
use Event\NewStatusUpdateEvent;
use Import\Dto\IncidentDto;
use Import\Dto\RegionDto;
use Import\Dto\UpdateDto;
use Model\Region;
use Model\StatusUpdate;
use Repository\StatusUpdateRepository;
use Symfony\Component\EventDispatcher\EventDispatcher;

class StatusImportService
{
    /**
     * @var StatusImportClient
     */
    private $importClient;

    /**
     * @var StatusUpdateRepository
     */
    private $statusUpdateRepository;

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
        $this->statusUpdateRepository = $entityManager->getRepository(StatusUpdate::class);
        $this->eventDispatcher = $eventDispatcher;
    }

    public function checkForNewStatusUpdates(Region $region) : int
    {
        $updateCount = 0;
        $regionDto = $this->importClient->getStatusForRegion($region);
        foreach ($regionDto->services as $serviceDto) {
            foreach ($serviceDto->incidents as $incidentDto) {
                foreach ($incidentDto->updates as $updateDto) {
                    if (!$this->updateExists($updateDto, $incidentDto, $regionDto)) {
                        $event = new NewStatusUpdateEvent($updateDto, $incidentDto, $serviceDto, $regionDto);
                        $this->eventDispatcher->dispatch('status_update.new', $event);
                        $updateCount++;
                    }
                }
            }
        }
        return $updateCount;
    }

    private function updateExists(UpdateDto $updateDto, IncidentDto $incidentDto, RegionDto $regionDto) : bool
    {
        $statusUpdate = $this->statusUpdateRepository->findUpdate($updateDto->id, $incidentDto->id, $regionDto->slug);
        return isset($statusUpdate);
    }
}
