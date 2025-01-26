<?php

namespace BotMan\Drivers\Instagram\Extensions\Airline;

use BotMan\Drivers\Instagram\Interfaces\Airline;
use JsonSerializable;

abstract class AbstractAirlineFlightInfo implements JsonSerializable, Airline
{
    /**
     * @var string
     */
    protected $flightNumber;

    /**
     * @var \BotMan\Drivers\Instagram\Extensions\Airline\AirlineAirport
     */
    protected $departureAirport;

    /**
     * @var \BotMan\Drivers\Instagram\Extensions\Airline\AirlineAirport
     */
    protected $arrivalAirport;

    /**
     * @var \BotMan\Drivers\Instagram\Extensions\Airline\AirlineFlightSchedule
     */
    protected $flightSchedule;

    /**
     * AbstractAirlineFlightInfo constructor.
     *
     * @param string                                                            $flightNumber
     * @param \BotMan\Drivers\Instagram\Extensions\Airline\AirlineAirport        $departureAirport
     * @param \BotMan\Drivers\Instagram\Extensions\Airline\AirlineAirport        $arrivalAirport
     * @param \BotMan\Drivers\Instagram\Extensions\Airline\AirlineFlightSchedule $flightSchedule
     */
    public function __construct(
        string $flightNumber,
        AirlineAirport $departureAirport,
        AirlineAirport $arrivalAirport,
        AirlineFlightSchedule $flightSchedule
    ) {
        $this->flightNumber = $flightNumber;
        $this->departureAirport = $departureAirport;
        $this->arrivalAirport = $arrivalAirport;
        $this->flightSchedule = $flightSchedule;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'flight_number' => $this->flightNumber,
            'departure_airport' => $this->departureAirport,
            'arrival_airport' => $this->arrivalAirport,
            'flight_schedule' => $this->flightSchedule,
        ];
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
