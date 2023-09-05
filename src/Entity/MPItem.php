<?php


namespace App\Entity;

class MPItem
{
    private $Orderable;
    private $Visible;

    public function getOrderable(): ?Orderable
    {
        return $this->Orderable;
    }

    public function setOrderable(Orderable $orderable): self
    {
        $this->Orderable = $orderable;
        return $this;
    }

    public function getVisible(): ?Visible
    {
        return $this->Visible;
    }

    public function setVisible(Visible $visible): self
    {
        $this->Visible = $visible;
        return $this;
    }

    public function toArray(): array {
        return [
            'Orderable' => $this->Orderable->toArray(),
            'Visible' => $this->Visible->toArray(),
        ];
    }
        
}
