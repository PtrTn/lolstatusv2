<?php

namespace EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use Event\NewStatusUpdateEvent;
use Import\StatusUpdateFactory;
use Messenger\Facebook\FacebookMessengerService;
use Model\StatusUpdate;
use Repository\StatusUpdateRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class StatusUpdateEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var StatusUpdateRepository
     */
    private $incidentRepository;
    /**
     * @var FacebookMessengerService
     */
    private $facebookMessengerService;
    /**
     * @var StatusUpdateFactory
     */
    private $statusUpdateFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        StatusUpdateFactory $statusUpdateFactory,
        FacebookMessengerService $facebookMessengerService
    ) {
        $this->incidentRepository = $entityManager->getRepository(StatusUpdate::class);
        $this->statusUpdateFactory = $statusUpdateFactory;
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
            'status_update.new' => 'handleNewIncidentEvent',
        ];
    }

    public function handleNewIncidentEvent(NewStatusUpdateEvent $event)
    {
        $statusUpdate = $this->statusUpdateFactory->createFromDtos(
            $event->getUpdateDto(),
            $event->getIncidentDto(),
            $event->getServiceDto(),
            $event->getRegionDto()
        );
        $this->incidentRepository->save($statusUpdate);
        $this->facebookMessengerService->sendMessage($statusUpdate);
    }
}
