<?php

namespace Import\Dto;

use stdClass;
use Webmozart\Assert\Assert;

class Update
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string|null
     */
    public $author;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $severity;

    /**
     * @var string
     */
    public $created_at;

    /**
     * @var string
     */
    public $updated_at;

    /**
     * @var string
     */
    public $translations;

    public static function fromStdClass(stdClass $update) : self
    {
        Assert::stringNotEmpty($update->id);
        Assert::string($update->author);
        Assert::stringNotEmpty($update->content);
        Assert::stringNotEmpty($update->severity);
        Assert::stringNotEmpty($update->created_at);
        Assert::stringNotEmpty($update->updated_at);

        $updateDto = new self();
        $updateDto->id = $update->id;
        $updateDto->author = $update->author;
        $updateDto->content = $update->content;
        $updateDto->severity = $update->severity;
        $updateDto->created_at = $update->created_at;
        $updateDto->updated_at = $update->updated_at;
        return $updateDto;
    }
}
