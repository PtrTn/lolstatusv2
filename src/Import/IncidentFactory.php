<?php

namespace Import;

use DateTimeImmutable;
use Import\Dto\ServiceDto;
use Import\Dto\StatusDto;
use Model\Incident;
use Model\Update;
use Import\Dto\IncidentDto as IncidentDto;
use Import\Dto\UpdateDto as UpdateDto;

class IncidentFactory
{
    public function createIncidentFromDto(IncidentDto $incident, StatusDto $status, ServiceDto $service) : Incident
    {
        return new Incident(
            $incident->id,
            $status->slug,
            $service->slug,
            $service->status,
            $incident->active,
            new DateTimeImmutable($incident->created_at),
            $this->createUpdatesFromDto($incident->updates)
        );
    }

    /**
     * @param UpdateDto[] $updateDtos
     * @return array
     */
    private function createUpdatesFromDto(array $updateDtos) : array
    {
        $updates = [];
        foreach ($updateDtos as $dto) {
            $updates[] = $this->createUpdateFromDto($dto);
        }
        return $updates;
    }

    private function createUpdateFromDto(UpdateDto $dto) : Update
    {
        return new Update(
            $dto->id,
            !empty($dto->author) ? $dto->author: null,
            $dto->content,
            $dto->severity,
            new DateTimeImmutable($dto->created_at),
            new DateTimeImmutable($dto->updated_at)
        );
    }
}
