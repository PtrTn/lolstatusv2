<?php

namespace Import;

use GuzzleHttp\Client;
use Import\Dto\RegionDto;
use Import\Exception\ImportFailedException;
use Model\Region;
use Psr\Http\Message\ResponseInterface;

class StatusImportClient
{
    /**
     * @var Client
     */
    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getStatusForRegion(Region $region) : RegionDto
    {
        try {
            $response = $this->httpClient->get($region->toString());
        } catch (\Exception $e) {
            throw new ImportFailedException();
        }
        return $this->createStatusFromResponse($response);
    }

    public function createStatusFromResponse(ResponseInterface $response) : RegionDto
    {
        $contents = $response->getBody()->getContents();
        if (empty($contents)) {
            throw new ImportFailedException();
        }
        $decoded = \GuzzleHttp\json_decode($contents, false);
        return RegionDto::fromStdClass($decoded);
    }
}
