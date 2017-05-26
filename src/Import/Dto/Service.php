<?php

namespace Import\Dto;

use stdClass;
use Webmozart\Assert\Assert;

class Service
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $status;

    /**
     * @var Incident[]
     */
    public $incidents;

    public static function fromStdClass(stdClass $service) : self
    {
        Assert::stringNotEmpty($service->name);
        Assert::stringNotEmpty($service->slug);
        Assert::stringNotEmpty($service->status);
        $serviceDto = new self();
        $serviceDto->name = $service->name;
        $serviceDto->slug = $service->slug;
        $serviceDto->status = $service->status;
        $incidentDtos = [];
        foreach ($service->incidents as $incident) {
            $incidentDtos[] = Incident::fromStdClass($incident);
        }
        $serviceDto->incidents = $incidentDtos;
        return $serviceDto;
    }
}
