<?php

namespace ServiceProviders;

use Messenger\Facebook\FacebookMessageFactory;
use Messenger\Facebook\FacebookMessengerService;
use Pimple\ServiceProviderInterface;
use Pimple\Container;
use Webmozart\Assert\Assert;

class MessengerServiceProvider implements ServiceProviderInterface
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
        $container[FacebookMessageFactory::class] = function () use ($container) {
            Assert::stringNotEmpty($container['config']['status_page_url']);
            return new FacebookMessageFactory(
                $container['config']['status_page_url']
            );
        };
        $container[FacebookMessengerService::class] = function () use ($container) {
            return new FacebookMessengerService(
                $container[FacebookMessageFactory::class],
                $container['config']['facebook']['app_id'],
                $container['config']['facebook']['app_secret'],
                $container['config']['facebook']['access_token']
            );
        };
    }
}
