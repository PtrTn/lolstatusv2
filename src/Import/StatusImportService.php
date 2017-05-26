<?php

namespace Import;

use DateTime;
use Model\Incident;
use Model\Region;
use Model\Status;
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
                        new DateTime($update->created_at),
                        new DateTime($update->updated_at)
                    );
                }
                $incidents[] = new Incident(
                    $status->slug,
                    $service->slug,
                    $service->status,
                    $incident->id,
                    $incident->active,
                    new DateTime($incident->created_at),
                    $updates
                );
            }
        }
        return $incidents;
    }
}
