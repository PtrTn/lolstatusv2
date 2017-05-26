<?php

namespace ServiceProviders;

use GuzzleHttp\Client as HttpClient;
use Import\StatusImportClient;
use Import\StatusImportService;
use Pimple\ServiceProviderInterface;
use Pimple\Container;
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
            Assert::stringNotEmpty($container['config']['api-url']);
            $httpClient = new HttpClient([
                'base_uri' => $container['config']['api-url']
            ]);
            return new StatusImportClient($httpClient);
        };
        $container[StatusImportService::class] = function () use ($container) {
            return new StatusImportService(
                $container[StatusImportClient::class]
            );
        };
    }
}
