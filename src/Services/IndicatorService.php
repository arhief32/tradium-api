<?php

namespace App\Services;

class IndicatorService
{

    public function sma($prices, $period = 14)
    {
        $sma = [];

        for ($i = 0; $i < count($prices); $i++) {

            if ($i + 1 < $period) {
                $sma[] = null;
                continue;
            }

            $slice = array_slice($prices, $i - $period + 1, $period);

            $sma[] = array_sum($slice) / $period;
        }

        return $sma;
    }

    public function ema($prices, $period = 14)
    {
        $ema = [];
        $multiplier = 2 / ($period + 1);

        // SMA pertama sebagai seed
        $sma = array_sum(array_slice($prices, 0, $period)) / $period;
        $ema[$period - 1] = $sma;

        for ($i = $period; $i < count($prices); $i++) {
            $ema[$i] = (($prices[$i] - $ema[$i - 1]) * $multiplier) + $ema[$i - 1];
        }

        return $ema;
    }

    public function rsi($prices, int $period = 14)
    {
        $rsi = [];
        $gains = [];
        $losses = [];

        for ($i = 1; $i < count($prices); $i++) {
            $change = $prices[$i] - $prices[$i - 1];
            $gains[] = $change > 0 ? $change : 0;
            $losses[] = $change < 0 ? abs($change) : 0;
        }

        $avgGain = array_sum(array_slice($gains, 0, $period)) / $period;
        $avgLoss = array_sum(array_slice($losses, 0, $period)) / $period;

        for ($i = $period; $i < count($gains); $i++) {
            $avgGain = (($avgGain * ($period - 1)) + $gains[$i]) / $period;
            $avgLoss = (($avgLoss * ($period - 1)) + $losses[$i]) / $period;

            $rs = $avgLoss == 0 ? 0 : $avgGain / $avgLoss;
            $rsi[$i] = 100 - (100 / (1 + $rs));
        }

        return $rsi;
    }
}
