<?php

namespace Messenger;

use Messenger\Dto\FacebookMessage;
use Model\Incident;
use Model\Update;

class FacebookMessageFactory
{
    /**
     * @var string
     */
    private $statusPageUrl;

    public function __construct(string $statusPageUrl)
    {
        $this->statusPageUrl = $statusPageUrl;
    }

    /**
     * @param Incident $incident
     * @return FacebookMessage[]
     */
    public function createMessagesFromIncident(Incident $incident) : array
    {
        $messages = [];
        foreach ($incident->getUpdates() as $update) {
            $dto = $this->createMessageFromUpdate($incident, $update);
            $messages[] = $dto;
        }
        return $messages;
    }

    public function createMessageFromIncidentUpdate(Incident $oldIncident, Incident $updatedIncident) : array
    {
        $updates = $this->getNewUpdates($oldIncident, $updatedIncident);
        $messages = [];
        foreach ($updates as $update) {
            $messages[] = $this->createMessageFromUpdate($updatedIncident, $update);
        }
        return $messages;
    }

    private function createMessageFromUpdate(Incident $incident, Update $update) : FacebookMessage
    {
        $dto = new FacebookMessage();
        $dto->author = $update->getAuthor();
        $dto->region = $incident->getRegion();
        $dto->readmore = $this->statusPageUrl . '/#/' . $incident->getRegion();
        $dto->message = $update->getContent();
        return $dto;
    }


    private function getNewUpdates(Incident $oldIncident, Incident $updatedIncident) : array
    {
        $newUpdates = [];
        foreach ($updatedIncident->getUpdates() as $update) {
            if (!$this->incidentHasUpdate($oldIncident, $update)) {
                $newUpdates[] = $update;
            }
        }
        return $newUpdates;
    }

    private function incidentHasUpdate(Incident $incident, Update $update) : bool
    {
        $oldUpdates = $incident->getUpdates();
        foreach ($oldUpdates as $oldUpdate) {
            if ($update === $oldUpdate) {
                return true;
            }
        }
        return false;
    }
}
