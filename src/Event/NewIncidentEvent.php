<?php

namespace Event;

use Model\Incident;
use Symfony\Component\EventDispatcher\Event;

class NewIncidentEvent extends Event
{
    /**
     * @var Incident
     */
    private $incident;

    public function __construct(Incident $incident)
    {
        $this->incident = $incident;
    }

    /**
     * @return Incident
     */
    public function getIncident(): Incident
    {
        return $this->incident;
    }
}
