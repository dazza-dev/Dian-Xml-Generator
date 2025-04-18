<?php

namespace DazzaDev\DianXmlGenerator\Models;

class Total
{
    /**
     * Line extension amount
     */
    private float $lineExtensionAmount;

    /**
     * Tax exclusive amount
     */
    private float $taxExclusiveAmount;

    /**
     * Tax inclusive amount
     */
    private float $taxInclusiveAmount;

    /**
     * Prepaid amount
     */
    private float $prepaidAmount;

    /**
     * Payable amount
     */
    private float $payableAmount;

    /**
     * Total constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize totals data
     */
    private function initialize(array $data): void
    {
        $this->setLineExtensionAmount($data['line_extension_amount']);
        $this->setTaxExclusiveAmount($data['tax_exclusive_amount']);
        $this->setTaxInclusiveAmount($data['tax_inclusive_amount']);
        $this->setPrepaidAmount($data['prepaid_amount']);
        $this->setPayableAmount($data['payable_amount']);
    }

    /**
     * Get line extension amount
     */
    public function getLineExtensionAmount(): float
    {
        return $this->lineExtensionAmount;
    }

    /**
     * Set line extension amount
     */
    private function setLineExtensionAmount(float $lineExtensionAmount): void
    {
        $this->lineExtensionAmount = $lineExtensionAmount;
    }

    /**
     * Get tax exclusive amount
     */
    public function getTaxExclusiveAmount(): float
    {
        return $this->taxExclusiveAmount;
    }

    /**
     * Set tax exclusive amount
     */
    private function setTaxExclusiveAmount(float $taxExclusiveAmount): void
    {
        $this->taxExclusiveAmount = $taxExclusiveAmount;
    }

    /**
     * Get tax inclusive amount
     */
    public function getTaxInclusiveAmount(): float
    {
        return $this->taxInclusiveAmount;
    }

    /**
     * Set tax inclusive amount
     */
    private function setTaxInclusiveAmount(float $taxInclusiveAmount): void
    {
        $this->taxInclusiveAmount = $taxInclusiveAmount;
    }

    /**
     * Get prepaid amount
     */
    public function getPrepaidAmount(): float
    {
        return $this->prepaidAmount;
    }

    /**
     * Set prepaid amount
     */
    private function setPrepaidAmount(float $prepaidAmount): void
    {
        $this->prepaidAmount = $prepaidAmount;
    }

    /**
     * Get payable amount
     */
    public function getPayableAmount(): float
    {
        return $this->payableAmount;
    }

    /**
     * Set payable amount
     */
    private function setPayableAmount(float $payableAmount): void
    {
        $this->payableAmount = $payableAmount;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'line_extension_amount' => $this->getLineExtensionAmount(),
            'tax_exclusive_amount' => $this->getTaxExclusiveAmount(),
            'tax_inclusive_amount' => $this->getTaxInclusiveAmount(),
            'prepaid_amount' => $this->getPrepaidAmount(),
            'payable_amount' => $this->getPayableAmount(),
        ];
    }
}
