<?php

namespace Event;

use Model\Incident;
use Symfony\Component\EventDispatcher\Event;

class UpdatedIncidentEvent extends Event
{
    /**
     * @var Incident
     */
    private $oldIncident;
    /**
     * @var Incident
     */
    private $updatedIncident;

    public function __construct(Incident $oldIncident, Incident $updatedIncident)
    {
        $this->oldIncident = $oldIncident;
        $this->updatedIncident = $updatedIncident;
    }

    /**
     * @return Incident
     */
    public function getOldIncident(): Incident
    {
        return $this->oldIncident;
    }

    /**
     * @return Incident
     */
    public function getUpdatedIncident(): Incident
    {
        return $this->updatedIncident;
    }
}
