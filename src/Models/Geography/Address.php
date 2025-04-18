<?php

namespace DazzaDev\DianXmlGenerator\Models\Geography;

class Address
{
    /**
     * Address line
     */
    private string $addressLine;

    /**
     * Zip code
     */
    private ?string $zipCode = null;

    /**
     * Address constructor
     */
    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    /**
     * Set data from array
     */
    private function setData(array $data): void
    {
        if (empty($data)) {
            return;
        }

        $this->addressLine = $data['addressLine'];
        $this->zipCode = $data['zipCode'] ?? null;
    }

    /**
     * Get address line
     */
    public function getAddressLine(): string
    {
        return $this->addressLine;
    }

    /**
     * Set address line
     */
    public function setAddressLine(string $addressLine): void
    {
        $this->addressLine = $addressLine;
    }

    /**
     * Get zip code
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * Set zip code
     */
    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    /**
     * Convert address to array
     */
    public function toArray(): array
    {
        return [
            'address_line' => $this->addressLine,
            'zip_code' => $this->zipCode,
        ];
    }
}
