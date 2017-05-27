<?php

namespace Import;

use DateTimeImmutable;
use Import\Dto\Service;
use Import\Dto\Status;
use Model\Incident;
use Model\Update;
use Import\Dto\Incident as IncidentDto;
use Import\Dto\Update as UpdateDto;

class IncidentFactory
{
    public function createIncidentFromDto(IncidentDto $dto, Status $status, Service $service) : Incident
    {
        return new Incident(
            $dto->id,
            $status->slug,
            $service->slug,
            $service->status,
            $dto->active,
            new DateTimeImmutable($dto->created_at),
            $this->createUpdatesFromDto($dto->updates)
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
            $updates[] = new Update(
                $dto->id,
                !empty($dto->author) ? $dto->author: null,
                $dto->content,
                $dto->severity,
                new DateTimeImmutable($dto->created_at),
                new DateTimeImmutable($dto->updated_at)
            );
        }
        return $updates;
    }
}
