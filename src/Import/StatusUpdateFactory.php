<?php

namespace Import;

use DateTimeImmutable;
use Import\Dto\RegionDto;
use Import\Dto\ServiceDto;
use Model\StatusUpdate;
use Import\Dto\IncidentDto as IncidentDto;
use Import\Dto\UpdateDto as UpdateDto;

class StatusUpdateFactory
{
    public function createFromDtos(
        UpdateDto $updateDto,
        IncidentDto $incidentDto,
        ServiceDto $serviceDto,
        RegionDto $regionDto
    ) : StatusUpdate {
        return new StatusUpdate(
            $incidentDto->id,
            $updateDto->id,
            $regionDto->slug,
            $regionDto->name,
            $serviceDto->name,
            $serviceDto->status,
            !empty($updateDto->author) ? $updateDto->author : null,
            $updateDto->content,
            $updateDto->severity,
            new DateTimeImmutable($updateDto->created_at),
            new DateTimeImmutable($updateDto->updated_at)
        );
    }
}
