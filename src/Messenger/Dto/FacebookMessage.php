<?php

namespace Messenger\Dto;

class FacebookMessage
{
    /**
     * @var string
     */
    public $region;

    /**
     * @var string|null
     */
    public $author;

    /**
     * @var string
     */
    public $message;

    /**
     * @var string
     */
    public $readmore;

    public function toString() : string
    {
        $parts = [];
        $parts[] = ucfirst($this->region);
        if (isset($this->author)) {
            $parts[] = $this->author;
        }
        $parts[] = $this->message;
        return implode(' - ', $parts);
    }
}
