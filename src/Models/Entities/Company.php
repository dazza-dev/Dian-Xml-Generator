<?php

namespace DazzaDev\DianXmlGenerator\Models\Entities;

class Company extends Entity
{
    /**
     * Merchant registration
     */
    private ?string $merchantRegistration = null;

    /**
     * Company constructor
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * Get merchant registration
     */
    public function getMerchantRegistration(): ?string
    {
        return $this->merchantRegistration;
    }

    /**
     * Set merchant registration
     */
    public function setMerchantRegistration(string $merchantRegistration): void
    {
        $this->merchantRegistration = $merchantRegistration;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return parent::toArray() + [
            'merchant_registration' => $this->getMerchantRegistration(),
        ];
    }
}
