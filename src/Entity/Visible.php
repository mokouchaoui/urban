<?php

namespace App\Entity;

class Visible
{
    private $Jewelry;

    // Assuming you have a Jewelry class created
    public function getJewelry(): ?Jewelry
    {
        return $this->Jewelry;
    }

    public function setJewelry(Jewelry $jewelry): self
    {
        $this->Jewelry = $jewelry;
        return $this;
    }

    public function toArray(): array {
        return [
            'Jewelry' => $this->Jewelry->toArray(),
        ];
    }
    
}
