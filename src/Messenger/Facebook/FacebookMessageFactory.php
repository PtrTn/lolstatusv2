<?php

namespace Messenger\Facebook;

use Messenger\Facebook\Dto\FacebookMessage;
use Model\StatusUpdate;

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

    public function createMessageFromStatusUpdate(StatusUpdate $statusUpdate) : FacebookMessage
    {
        $dto = new FacebookMessage();
        $dto->author = $statusUpdate->getAuthor();
        $dto->region = $statusUpdate->getRegionName();
        $dto->readmore = $this->statusPageUrl . '/#/' . $statusUpdate->getRegionSlug();
        $dto->message = $statusUpdate->getContent();
        return $dto;
    }
}
