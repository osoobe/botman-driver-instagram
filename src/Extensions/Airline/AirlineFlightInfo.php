<?php

namespace BotMan\Drivers\Instagram\Extensions\Airline;

class AirlineFlightInfo extends AbstractAirlineFlightInfo
{
    /**
     * @param string                                                            $flightNumber
     * @param \BotMan\Drivers\Instagram\Extensions\Airline\AirlineAirport        $departureAirport
     * @param \BotMan\Drivers\Instagram\Extensions\Airline\AirlineAirport        $arrivalAirport
     * @param \BotMan\Drivers\Instagram\Extensions\Airline\AirlineFlightSchedule $flightSchedule
     *
     * @return \BotMan\Drivers\Instagram\Extensions\Airline\AirlineFlightInfo
     */
    public static function create(
        string $flightNumber,
        AirlineAirport $departureAirport,
        AirlineAirport $arrivalAirport,
        AirlineFlightSchedule $flightSchedule
    ): self {
        return new self($flightNumber, $departureAirport, $arrivalAirport, $flightSchedule);
    }
}
