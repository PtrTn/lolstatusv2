<?php

namespace ServiceProviders;

use EventSubscriber\IncidentEventSubscriber;
use GuzzleHttp\Client as HttpClient;
use Import\StatusImportClient;
use Import\StatusImportService;
use Import\StatusUpdateFactory;
use Messenger\FacebookMessengerService;
use Pimple\ServiceProviderInterface;
use Pimple\Container;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Webmozart\Assert\Assert;

class ImportServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $container A container instance
     */
    public function register(Container $container)
    {
        $container[StatusImportClient::class] = function () use ($container) {
            Assert::stringNotEmpty($container['config']['api_url']);
            $httpClient = new HttpClient([
                'base_uri' => $container['config']['api_url']
            ]);
            return new StatusImportClient($httpClient);
        };
        $container[StatusImportService::class] = function () use ($container) {
            return new StatusImportService(
                $container[StatusImportClient::class],
                $container['orm.em'],
                $container['dispatcher']
            );
        };

        $container[StatusUpdateFactory::class] = function () {
            return new StatusUpdateFactory();
        };

        /** @var EventDispatcher $eventDispatcher */
        $eventDispatcher = $container['dispatcher'];
        $eventDispatcher->addSubscriber(
            new IncidentEventSubscriber(
                $container['orm.em'],
                $container[FacebookMessengerService::class],
                $container[StatusUpdateFactory::class]
            )
        );
    }
}
