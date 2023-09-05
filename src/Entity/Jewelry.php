<?php

namespace App\Entity;

use Symfony\Bundle\MakerBundle\Str;

class Jewelry
{
    private $shortDescription;
    private $mainImageUrl;
    private $productSecondaryImageURL = [];
    private $gender;
    private $size;
    private $color;
    private $metal;
    private $keyFeatures = ["@generated"];

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    public function getMainImageUrl(): ?string
    {
        return $this->mainImageUrl;
    }

    public function setMainImageUrl(string $mainImageUrl): self
    {
        $this->mainImageUrl = $mainImageUrl;
        return $this;
    }

    public function getProductSecondaryImageURL(): ?string
{
    return $this->productSecondaryImageURL[0] ?? null;
}

public function setProductSecondaryImageURL(string $productSecondaryImageURL): self
{
    $this->productSecondaryImageURL = [$productSecondaryImageURL];
    return $this;
}

public function getProductSecondaryImageURLArray(): ?array
{
    return $this->productSecondaryImageURL;
}

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function getSize(): ?String
    {
        return $this->size;
    }

    public function setSize(String $size): self
    {
        $this->size = $size;
        return $this;
    }

    public function getColor(): ?array
    {
        return $this->color;
    }

    public function setColor(array $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function getMetal(): ?string
    {
        return $this->metal;
    }

    public function setMetal(string $metal): self
    {
        $this->metal = $metal;
        return $this;
    }

    public function getKeyFeatures(): ?array
    {
        return ["@generated"];
    }

    public function setKeyFeatures(array $keyFeatures): self
    {
        $this->keyFeatures = $keyFeatures;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'shortDescription' => $this->shortDescription,
            'mainImageUrl' => $this->mainImageUrl,
            'productSecondaryImageURL' => $this->productSecondaryImageURL,
            'gender' => $this->gender,
            'size' => $this->size,
            'color' => $this->color,
            'metal' => $this->metal,
            'keyFeatures' => $this->keyFeatures
        ];
    }
}
