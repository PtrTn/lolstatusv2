<?php

namespace Event;

use Import\Dto\IncidentDto;
use Import\Dto\RegionDto;
use Import\Dto\ServiceDto;
use Import\Dto\UpdateDto;
use Symfony\Component\EventDispatcher\Event;

class NewStatusUpdateEvent extends Event
{
    /**
     * @var UpdateDto
     */
    private $updateDto;
    /**
     * @var IncidentDto
     */
    private $incidentDto;
    /**
     * @var ServiceDto
     */
    private $serviceDto;
    /**
     * @var RegionDto
     */
    private $regionDto;

    public function __construct(
        UpdateDto $updateDto,
        IncidentDto $incidentDto,
        ServiceDto $serviceDto,
        RegionDto $regionDto
    ) {
        $this->updateDto = $updateDto;
        $this->incidentDto = $incidentDto;
        $this->serviceDto = $serviceDto;
        $this->regionDto = $regionDto;
    }

    /**
     * @return UpdateDto
     */
    public function getUpdateDto(): UpdateDto
    {
        return $this->updateDto;
    }

    /**
     * @return IncidentDto
     */
    public function getIncidentDto(): IncidentDto
    {
        return $this->incidentDto;
    }

    /**
     * @return ServiceDto
     */
    public function getServiceDto(): ServiceDto
    {
        return $this->serviceDto;
    }

    /**
     * @return RegionDto
     */
    public function getRegionDto(): RegionDto
    {
        return $this->regionDto;
    }
}
