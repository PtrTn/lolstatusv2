<?php
namespace Messenger;

use Model\StatusUpdate;

interface MessengerInterface
{
    public function sendMessage(StatusUpdate $statusUpdate) : void;
}
