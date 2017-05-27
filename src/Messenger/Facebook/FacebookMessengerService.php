<?php

namespace Messenger\Facebook;

use Facebook\Facebook;
use Messenger\Facebook\Exception\FacebookMessageException;
use Messenger\MessengerInterface;
use Model\StatusUpdate;

class FacebookMessengerService implements MessengerInterface
{
    /**
     * @var FacebookMessageFactory
     */
    private $messageFactory;

    /**
     * @var Facebook
     */
    private $facebook;

    /**
     * @var string
     */
    private $accessToken;

    public function __construct(
        FacebookMessageFactory $messageFactory,
        string $appId,
        string $appSecret,
        string $accessToken
    ) {
        $this->accessToken = $accessToken;
        $this->facebook = new Facebook([
            'app_id' => $appId,
            'app_secret' => $appSecret,
            'default_graph_version' => 'v2.9',
            'http_client_handler' => 'curl',
            'access_token' => $accessToken
        ]);
        $this->messageFactory = $messageFactory;
    }

    public function sendMessage(StatusUpdate $statusUpdate) : void
    {
        $message = $this->messageFactory->createMessageFromStatusUpdate($statusUpdate);
        var_dump('Not sending message', $message->toString());
        return;
        $response = $this->facebook->post(
            '/813062038724116/feed',
            [
                'message' => $message->toString(),
                'link' => $message->readmore,
                'name' => 'League of legends service status',
                'caption' => 'The official League of Legends status page',
                'description' => 'Live service status updates for every region containing information
                                about game, store, forums and website availability and maintenance'
            ],
            $this->accessToken
        );
        if ($response->getHttpStatusCode() !== 200) {
            throw new FacebookMessageException();
        }
        return;
    }
}
