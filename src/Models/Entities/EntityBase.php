<?php

namespace DazzaDev\DianXmlGenerator\Models\Entities;

use DazzaDev\DianXmlGenerator\DataLoader;
use Rmunate\DianColombia\DIAN;

class EntityBase
{
    /**
     * Identification type
     */
    private IdentificationType $identificationType;

    /**
     * Identification number
     */
    private string $identificationNumber;

    /**
     * Verification code
     */
    private string $verificationCode;

    /**
     * Entity Base constructor
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

        // Identification type
        $this->setIdentificationType($data['identification_type']);

        // Identification number
        $this->setIdentificationNumber($data['identification_number']);
    }

    /**
     * Get identification type
     */
    public function getIdentificationType(): IdentificationType
    {
        return $this->identificationType;
    }

    /**
     * Set identification type
     */
    public function setIdentificationType(int|string $identificationTypeCode): void
    {
        $identificationType = (new DataLoader('identification-types'))->getByCode($identificationTypeCode);

        $this->identificationType = new IdentificationType($identificationType);
    }

    /**
     * Get identification number
     */
    public function getIdentificationNumber(): string
    {
        return $this->identificationNumber;
    }

    /**
     * Set identification number
     */
    public function setIdentificationNumber(string $identificationNumber): void
    {
        $this->identificationNumber = $identificationNumber;

        // Calculate verification code
        $this->verificationCode = DIAN::digitoVerificacion($this->identificationNumber);
    }

    /**
     * Get verification code
     */
    public function getVerificationCode(): string
    {
        return $this->verificationCode;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'identification_type' => $this->identificationType?->toArray(),
            'identification_number' => $this->identificationNumber,
            'verification_code' => $this->verificationCode,
        ];
    }
}
