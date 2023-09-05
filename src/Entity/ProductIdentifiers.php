<?php

namespace App\Entity;

class ProductIdentifiers
{
    private $productIdType;
    private $productId;

    public function getProductIdType(): ?string
    {
        return $this->productIdType;
    }

    public function setProductIdType(string $productIdType): self
    {
        $this->productIdType = $productIdType;
        return $this;
    }

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function toArray(): array {
        return [
            'productIdType' => $this->productIdType,
            'productId' => $this->productId
        ];
    }
    
}
