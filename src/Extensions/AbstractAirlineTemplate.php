<?php

namespace BotMan\Drivers\Instagram\Extensions;

use BotMan\BotMan\Interfaces\WebAccess;
use BotMan\Drivers\Instagram\Interfaces\Airline;
use JsonSerializable;

abstract class AbstractAirlineTemplate implements JsonSerializable, WebAccess, Airline
{
    /**
     * @var string
     */
    protected $locale;

    /**
     * @var null|string
     */
    protected $themeColor;

    /**
     * AbstractAirlineTemplate constructor.
     *
     * @param string $locale
     */
    public function __construct(string $locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param string $themeColor
     *
     * @return \BotMan\Drivers\Instagram\Extensions\AbstractAirlineTemplate
     */
    public function themeColor(string $themeColor): self
    {
        $this->themeColor = $themeColor;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'attachment' => [
                'type' => 'template',
                'payload' => [
                    'locale' => $this->locale,
                    'theme_color' => $this->themeColor,
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Get the instance as a web accessible array.
     * This will be used within the WebDriver.
     *
     * @return array
     */
    public function toWebDriver(): array
    {
        return [
            'locale' => $this->locale,
            'theme_color' => $this->themeColor,
        ];
    }
}
