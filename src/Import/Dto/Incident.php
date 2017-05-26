<?php

namespace Import\Dto;

use stdClass;
use Webmozart\Assert\Assert;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Incident
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var bool
     */
    public $active;

    /**
     * @var string
     */
    public $created_at;

    /**
     * @var Update[]
     */
    public $updates;

    public static function fromStdClass(stdClass $incident) : self
    {
        Assert::integer($incident->id);
        Assert::boolean($incident->active);
        Assert::stringNotEmpty($incident->created_at);
        Assert::notEmpty($incident->updates);
        $incidentDto = new self();
        $incidentDto->id = $incident->id;
        $incidentDto->active = $incident->active;
        $incidentDto->created_at = $incident->created_at;

        $updateDtos = [];
        foreach ($incident->updates as $update) {
            $updateDtos[] = Update::fromStdClass($update);
        }
        $incidentDto->updates = $updateDtos;
        return $incidentDto;
    }
}
