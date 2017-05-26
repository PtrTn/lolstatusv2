<?php

namespace EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use Event\NewIncidentEvent;
use Event\UpdatedIncidentEvent;
use Messenger\FacebookMessengerService;
use Model\Incident;
use Repository\IncidentRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class IncidentEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var IncidentRepository
     */
    private $incidentRepository;
    /**
     * @var FacebookMessengerService
     */
    private $facebookMessengerService;

    public function __construct(
        EntityManagerInterface $entityManager,
        FacebookMessengerService $facebookMessengerService
    ) {
        $this->incidentRepository = $entityManager->getRepository(Incident::class);
        $this->facebookMessengerService = $facebookMessengerService;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            'incident.new' => 'handleNewIncidentEvent',
            'incident.updated' => 'handleUpdatedIncidentEvent'
        ];
    }

    public function handleNewIncidentEvent(NewIncidentEvent $event)
    {
        $this->incidentRepository->save($event->getIncident());
        $this->facebookMessengerService->postIncident($event->getIncident());
    }

    public function handleUpdatedIncidentEvent(UpdatedIncidentEvent $event)
    {
        $this->incidentRepository->remove($event->getOldIncident());
        $this->incidentRepository->remove($event->getUpdatedIncident());
        $this->facebookMessengerService->postIncidentUpdate(
            $event->getOldIncident(),
            $event->getUpdatedIncident()
        );
    }
}
