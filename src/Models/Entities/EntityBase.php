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
     * Regime
     */
    private Regime $regime;

    /**
     * Tax scheme
     */
    private array $taxScheme;

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

        // Regime
        $this->setRegime($data['regime']);
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
     * Get regime
     */
    public function getRegime(): Regime
    {
        return $this->regime;
    }

    /**
     * Set regime
     */
    public function setRegime(int|string $regimeCode): void
    {
        $regime = (new DataLoader('regimes'))->getByCode($regimeCode);

        $this->calculateTaxScheme($regimeCode);

        $this->regime = new Regime($regime);
    }

    /**
     * Calculate tax scheme
     */
    private function calculateTaxScheme(string $regimeCode): void
    {
        $taxMapping = [
            '48' => ['code' => '01', 'name' => 'IVA'],
            '49' => ['code' => 'ZZ', 'name' => 'No aplica'],
            'O-06' => ['code' => '01', 'name' => 'IVA'],
            'R-99-PN' => ['code' => 'ZZ', 'name' => 'No aplica'],
        ];

        if (isset($taxMapping[$regimeCode])) {
            $this->taxScheme = $taxMapping[$regimeCode];
        }
    }

    /**
     * Get tax scheme
     */
    public function getTaxScheme(): array
    {
        return $this->taxScheme;
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
            'regime' => $this->regime?->toArray(),
            'tax_scheme' => $this->taxScheme,
        ];
    }
}
