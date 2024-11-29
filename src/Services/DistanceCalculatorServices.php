<?php

namespace App\Services;

class DistanceCalculatorServices
{
    private const EARTH_RADIUS = 6371;

    public function calculateDistance(
        float $latEvent,
        float $longEvent,
        float $latParticipant,
        float $longParticipant):float
    {
        $latEventRad = deg2rad($latEvent);
        $longEventRad = deg2rad($longEvent);
        $latParticipantRad = deg2rad($latParticipant);
        $longParticipantRad = deg2rad($longParticipant);

        $deltaLat = $latParticipantRad - $latEventRad;
        $deltaLong = $longParticipantRad - $longEventRad;

        $a = sin($deltaLat / 2) ** 2 +
            cos($latEventRad) * cos($latParticipantRad) *
            sin($deltaLong / 2) ** 2;

        $c = 2 * asin(sqrt($a));

        return self::EARTH_RADIUS * $c;
    }
}