<?php

namespace App\Services;

class IndicatorService
{

    public function sma($prices, $period = 14)
    {

        $result = [];

        for ($i = 0; $i < count($prices); $i++) {

            if ($i + 1 < $period) {
                $result[] = null;
                continue;
            }

            $slice = array_slice($prices, $i - $period + 1, $period);

            $result[] = array_sum($slice) / $period;
        }

        return $result;
    }
}
