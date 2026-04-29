<?php

namespace App\Services;

class StrategyService
{

    protected $indicator;

    public function __construct()
    {
        $this->indicator = new IndicatorService();
    }

    public function smaCrossover($closes)
    {

        $sma5  = $this->indicator->sma($closes, 5);
        $sma10 = $this->indicator->sma($closes, 10);

        $lastIndex = count($closes) - 1;

        if ($lastIndex < 1) {
            return null;
        }

        $prevFast = $sma5[$lastIndex - 1];
        $prevSlow = $sma10[$lastIndex - 1];

        $currFast = $sma5[$lastIndex];
        $currSlow = $sma10[$lastIndex];

        // skip kalau masih null
        if (!$prevFast || !$prevSlow || !$currFast || !$currSlow) {
            return null;
        }

        // 🔥 Golden Cross → BUY
        if ($prevFast <= $prevSlow && $currFast > $currSlow) {
            return "BUY";
        }

        // 🔥 Death Cross → SELL
        if ($prevFast >= $prevSlow && $currFast < $currSlow) {
            return "SELL";
        }

        return "HOLD";
    }

    public function smaCrossover921($closes)
    {

        $sma9  = $this->indicator->sma($closes, 9);
        $sma21 = $this->indicator->sma($closes, 21);

        $lastIndex = count($closes) - 1;

        if ($lastIndex < 1) {
            return null;
        }

        $prevFast = $sma9[$lastIndex - 1];
        $prevSlow = $sma21[$lastIndex - 1];

        $currFast = $sma9[$lastIndex];
        $currSlow = $sma21[$lastIndex];

        // skip kalau masih null
        if (!$prevFast || !$prevSlow || !$currFast || !$currSlow) {
            return null;
        }

        // 🔥 Golden Cross → BUY
        if ($prevFast <= $prevSlow && $currFast > $currSlow) {
            return "BUY";
        }

        // 🔥 Death Cross → SELL
        if ($prevFast >= $prevSlow && $currFast < $currSlow) {
            return "SELL";
        }

        return "HOLD";
    }
}