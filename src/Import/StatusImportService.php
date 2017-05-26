<?php

namespace Import;

use DateTimeImmutable;
use Model\Incident;
use Model\Region;
use Model\Update;

class StatusImportService
{
    /**
     * @var StatusImportClient
     */
    private $importClient;

    public function __construct(StatusImportClient $importClient)
    {
        $this->importClient = $importClient;
    }

    /**
     * @param Region $region
     * @return Incident[]
     */
    public function getIncidentsForRegion(Region $region) : array
    {
        $status = $this->importClient->getStatusForRegion($region);
        $incidents = [];
        foreach ($status->services as $service) {
            foreach ($service->incidents as $incident) {
                $updates = [];
                foreach ($incident->updates as $update) {
                    $updates[] = new Update(
                        $update->id,
                        $update->author,
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
