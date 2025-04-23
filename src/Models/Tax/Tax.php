<?php

namespace DazzaDev\DianXmlGenerator\Models\Tax;

use DazzaDev\DianXmlGenerator\DataLoader;

class Tax
{
    /**
     * Tax type
     */
    private TaxType $taxType;

    /**
     * Percent
     */
    private float $percent;

    /**
     * Tax amount
     */
    private float $taxAmount;

    /**
     * Taxable amount
     */
    private float $taxableAmount;

    /**
     * Tax constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize tax data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        $this->setTaxType($data['code']);
        $this->setPercent($data['percent']);
        $this->setTaxAmount($data['tax_amount']);
        $this->setTaxableAmount($data['taxable_amount']);
    }

    /**
     * Get code
     */
    public function getTaxType(): TaxType
    {
        return $this->taxType;
    }

    /**
     * Set code
     */
    public function setTaxType(string $taxTypeCode): void
    {
        $taxType = (new DataLoader('taxes'))->getByCode($taxTypeCode);

        $this->taxType = new TaxType($taxType);
    }

    /**
     * Get percent
     */
    public function getPercent(): float
    {
        return $this->percent;
    }

    /**
     * Set percent
     */
    public function setPercent(float $percent): void
    {
        $this->percent = max(0.0, $percent);
    }

    /**
     * Get tax amount
     */
    public function getTaxAmount(): float
    {
        return $this->taxAmount;
    }

    /**
     * Set tax amount
     */
    public function setTaxAmount(float $taxAmount): void
    {
        $this->taxAmount = max(0.0, $taxAmount);
    }

    /**
     * Get taxable amount
     */
    public function getTaxableAmount(): float
    {
        return $this->taxableAmount;
    }

    /**
     * Set taxable amount
     */
    public function setTaxableAmount(float $taxableAmount): void
    {
        $this->taxableAmount = max(0.0, $taxableAmount);
    }

    /**
     * Convert tax to array
     */
    public function toArray(): array
    {
        return [
            'tax_type' => $this->taxType->toArray(),
            'percent' => $this->percent,
            'tax_amount' => $this->taxAmount,
            'taxable_amount' => $this->taxableAmount,
        ];
    }
}
