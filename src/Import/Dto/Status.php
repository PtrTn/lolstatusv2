<?php

namespace Import\Dto;

use stdClass;
use Webmozart\Assert\Assert;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Status
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
     * @var array
     */
    public $locales;

    /**
     * @var string
     */
    public $hostname;

    /**
     * @var string
     */
    public $region_tag;

    /**
     * @var Service[]
     */
    public $services;

    public static function fromStdClass(stdClass $status) : self
    {
        Assert::stringNotEmpty($status->name);
        Assert::stringNotEmpty($status->slug);
        Assert::allStringNotEmpty($status->locales);
        Assert::stringNotEmpty($status->hostname);
        Assert::stringNotEmpty($status->region_tag);
        $statusDto = new self();
        $statusDto->name = $status->name;
        $statusDto->slug = $status->slug;
        $statusDto->locales = $status->locales;
        $statusDto->hostname = $status->hostname;
        $statusDto->region_tag = $status->region_tag;
        $statusDto->services = [];
        foreach ($status->services as $service) {
            $statusDto->services[] = Service::fromStdClass($service);
        }
        return $statusDto;
    }
}
