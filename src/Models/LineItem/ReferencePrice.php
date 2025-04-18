<?php

namespace DazzaDev\DianXmlGenerator\Models\LineItem;

use DazzaDev\DianXmlGenerator\DataLoader;

class ReferencePrice
{
    /**
     * Reference price
     */
    private array $reference;

    /**
     * Price amount
     */
    private float $priceAmount;

    /**
     * Reference price constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize reference price data
     */
    private function initialize(array $data): void
    {
        if (isset($data['price_amount']) && is_numeric($data['price_amount'])) {
            $this->setPriceAmount($data['price_amount']);
        }

        if (isset($data['code']) && is_string($data['code'])) {
            $this->setReferencePrice($data['code']);
        }
    }

    /**
     * Get reference price
     */
    public function setReferencePrice(string $code): void
    {
        $referencePrice = (new DataLoader('reference-prices'))->getByCode($code);

        $this->reference = $referencePrice;
    }

    /**
     * Get reference price code
     */
    public function getCode(): string
    {
        return $this->reference['code'];
    }

    /**
     * Get reference price name
     */
    public function getName(): string
    {
        return $this->reference['name'];
    }

    /**
     * Set price amount
     */
    private function setPriceAmount(float $priceAmount): void
    {
        $this->priceAmount = $priceAmount;
    }

    /**
     * Get price amount
     */
    public function getPriceAmount(): float
    {
        return $this->priceAmount;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'name' => $this->getName(),
            'price_amount' => $this->getPriceAmount(),
        ];
    }
}
