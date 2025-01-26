<?php

namespace BotMan\Drivers\Instagram\Extensions;

use BotMan\Drivers\Instagram\Exceptions\InstagramException;
use BotMan\Drivers\Instagram\Extensions\Airline\AirlineFlightInfo;

class AirlineUpdateTemplate extends AbstractAirlineTemplate
{
    /**
     * @var string
     */
    protected $introMessage;

    /**
     * @var string
     */
    protected $updateType;

    /**
     * @var string
     */
    protected $pnrNumber;

    /**
     * @var \BotMan\Drivers\Instagram\Extensions\Airline\AirlineFlightInfo
     */
    protected $updateFlightInfo;

    /**
     * AirlineUpdateTemplate constructor.
     *
     * @param string                                                        $updateType
     * @param string                                                        $locale
     * @param string                                                        $pnrNumber
     * @param \BotMan\Drivers\Instagram\Extensions\Airline\AirlineFlightInfo $updateFlightInfo
     *
     * @throws \BotMan\Drivers\Instagram\Exceptions\InstagramException
     */
    public function __construct(
        string $updateType,
        string $locale,
        string $pnrNumber,
        AirlineFlightInfo $updateFlightInfo
    ) {
        if (! \in_array($updateType, self::UPDATE_TYPES, true)) {
            throw new InstagramException(
                sprintf('update_type must be either "%s"', implode(', ', self::UPDATE_TYPES))
            );
        }

        parent::__construct($locale);

        $this->updateType = $updateType;
        $this->locale = $locale;
        $this->pnrNumber = $pnrNumber;
        $this->updateFlightInfo = $updateFlightInfo;
    }

    /**
     * @param string $introMessage
     *
     * @return \BotMan\Drivers\Instagram\Extensions\AirlineUpdateTemplate
     */
    public function introMessage(string $introMessage): self
    {
        $this->introMessage = $introMessage;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = parent::toArray();

        return array_merge_recursive($array, [
            'attachment' => [
                'payload' => [
                    'template_type' => 'airline_update',
                    'intro_message' => $this->introMessage,
                    'update_type' => $this->updateType,
                    'pnr_number' => $this->pnrNumber,
                    'update_flight_info' => $this->updateFlightInfo,
                ],
            ],
        ]);
    }

    /**
     * Get the instance as a web accessible array.
     * This will be used within the WebDriver.
     *
     * @return array
     */
    public function toWebDriver(): array
    {
        $webDriver = parent::toWebDriver();
        $webDriver += [
            'template_type' => 'airline_update',
            'intro_message' => $this->introMessage,
            'update_type' => $this->updateType,
            'pnr_number' => $this->pnrNumber,
            'update_flight_info' => $this->updateFlightInfo,
        ];

        return $webDriver;
    }
}
