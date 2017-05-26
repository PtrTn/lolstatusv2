<?php

namespace Model;

use Webmozart\Assert\Assert;

class Region
{
    private const EUW = 'euw';
    private const NA = 'na';
    private const OCE = 'oce';
    private const LAN = 'lan';

    /**
     * @var string
     */
    private $region;

    private function __construct(string $region) {
        Assert::oneOf($region, [
            self::EUW,
            self::NA,
            self::OCE,
            self::LAN
        ]);
        $this->region = $region;
    }

    public static function euWest() : self {
        return new self(self::EUW);
    }

    public static function northAmerica() : self {
        return new self(self::NA);
    }

    public static function oceania() : self {
        return new self(self::OCE);
    }

    public static function latinAmericaNorth() : self
    {
        return new self(self::LAN);
    }

    public function toString() : string {
        return $this->region;
    }
}
