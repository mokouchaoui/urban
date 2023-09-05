<?php

namespace App\Entity;

class Product
{
    private  $sku;
    private  $quantity;

    public function __construct()
    {
        $this->quantity = new Quantity();
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;
        return $this;
    }

    public function getQuantity(): ?Quantity
    {
        return $this->quantity;
    }

    public function setQuantity(Quantity $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

}