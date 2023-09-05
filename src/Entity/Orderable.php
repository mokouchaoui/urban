<?php

namespace App\Entity;

class Orderable
{
    private $sku;
    private $productIdentifiers; 
    private $productName;
    private $brand;
    private $price;
    private $ShippingWeight;
    private $MustShipAlone;
    private $SkuUpdate;


    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;
        return $this;
    }

    public function getProductIdentifiers(): ?ProductIdentifiers
    {
        return $this->productIdentifiers;
    }

    public function setProductIdentifiers(ProductIdentifiers $productIdentifiers): self
    {
        $this->productIdentifiers = $productIdentifiers;
        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;
        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getShippingWeight(): ?float
    {
        return $this->ShippingWeight;
    }

    public function setShippingWeight(float $shippingWeight): self
    {
        $this->ShippingWeight = $shippingWeight;
        return $this;
    }

    public function getMustShipAlone(): ?string
    {
        return $this->MustShipAlone;
    }

    public function setMustShipAlone(string $mustShipAlone): self
    {
        $this->MustShipAlone = $mustShipAlone;
        return $this;
    }

    public function getSkuUpdate(): ?string
    {
        return $this->SkuUpdate;
    }

    public function setSkuUpdate(string $skuUpdate): self
    {
        $this->SkuUpdate = $skuUpdate;
        return $this;
    }

    public function toArray(): array {
        return [
            'sku' => $this->sku,
            'productIdentifiers' => $this->productIdentifiers->toArray(),
            'productName' => $this->productName,
            'brand' => $this->brand,
            'price' => $this->price,
            'ShippingWeight' => $this->ShippingWeight,
            'MustShipAlone' => $this->MustShipAlone,
            'SkuUpdate' => $this->SkuUpdate,
        ];
    }
    
}
