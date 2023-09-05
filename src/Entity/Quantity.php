<?php

namespace App\Entity;


class Quantity
{
    private $unit;
    private $amount;

    // default the unit to "EACH"
    public function __construct()
    {
        $this->unit = "EACH";
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }
}