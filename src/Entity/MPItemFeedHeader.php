<?php 


namespace App\Entity;

class MPItemFeedHeader
{
    private $sellingChannel;
    private $processMode;
    private $subset;
    private $locale;
    private $version;

    public function getSellingChannel(): ?string
    {
        return $this->sellingChannel;
    }

    public function setSellingChannel(string $sellingChannel): self
    {
        $this->sellingChannel = $sellingChannel;
        return $this;
    }

    public function getProcessMode(): ?string
    {
        return $this->processMode;
    }

    public function setProcessMode(string $processMode): self
    {
        $this->processMode = $processMode;
        return $this;
    }

    public function getSubset(): ?string
    {
        return $this->subset;
    }

    public function setSubset(string $subset): self
    {
        $this->subset = $subset;
        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

   


    public function toArray(): array {
        return [
            'sellingChannel' => $this->getSellingChannel(),
            'processMode' => $this->getProcessMode(),
            'subset' => $this->getSubset(),
            'locale' => $this->getLocale(),
            'version' => $this->getVersion(),
        ];
    }
    
}
