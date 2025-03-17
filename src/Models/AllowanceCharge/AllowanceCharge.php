<?php

namespace DazzaDev\DianXmlGenerator\Models\AllowanceCharge;

use DazzaDev\DianXmlGenerator\DataLoader;

class AllowanceCharge
{
    /**
     * Allowance charge indicator
     */
    private bool $isCharge;

    /**
     * Allowance charge reason
     */
    private AllowanceChargeReason $reason;

    /**
     * Allowance charge percentage
     */
    private float $percentage;

    /**
     * Allowance charge amount
     */
    private float $amount;

    /**
     * Allowance charge base amount
     */
    private float $baseAmount;

    /**
     * Allowance charge constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize allowance charge data
     */
    private function initialize(array $data): void
    {
        $this->setIsCharge($data['is_charge']);
        $this->setReason($data['reason_code'] ?? '00');
        $this->setPercentage($data['percentage']);
        $this->setAmount($data['amount']);
        $this->setBaseAmount($data['base_amount']);
    }

    /**
     * Get allowance charge indicator
     */
    public function getIsCharge(): bool
    {
        return $this->isCharge;
    }

    /**
     * Set allowance charge indicator
     */
    private function setIsCharge(bool $isCharge): void
    {
        $this->isCharge = $isCharge;
    }

    /**
     * Get allowance charge reason
     */
    public function getReason(): AllowanceChargeReason
    {
        return $this->reason;
    }

    /**
     * Set allowance charge reason
     */
    private function setReason(string $reasonCode): void
    {
        $reason = (new DataLoader('allowance-charges'))->getByCode($reasonCode);

        $this->reason = new AllowanceChargeReason($reason);
    }

    /**
     * Get allowance charge percentage
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }

    /**
     * Set allowance charge percentage
     */
    private function setPercentage(float $percentage): void
    {
        $this->percentage = $percentage;
    }

    /**
     * Get allowance charge amount
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Set allowance charge amount
     */
    private function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * Get allowance charge base amount
     */
    public function getBaseAmount(): float
    {
        return $this->baseAmount;
    }

    /**
     * Set allowance charge base amount
     */
    private function setBaseAmount(float $baseAmount): void
    {
        $this->baseAmount = $baseAmount;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'is_charge' => $this->isCharge,
            'reason' => $this->reason->toArray(),
            'percentage' => $this->percentage,
            'amount' => $this->amount,
            'base_amount' => $this->baseAmount,
        ];
    }
}
