<?php

namespace DazzaDev\DianXmlGenerator\Models\LineItem;

use DazzaDev\DianXmlGenerator\DataLoader;
use DazzaDev\DianXmlGenerator\Models\AllowanceCharge\AllowanceCharge;
use DazzaDev\DianXmlGenerator\Models\Tax\Tax;

class LineItem
{
    /**
     * Name
     */
    private string $name;

    /**
     * Code
     */
    private string $code;

    /**
     * Item type
     */
    private LineItemType $itemType;

    /**
     * Quantity
     */
    private float $quantity;

    /**
     * Unit
     */
    private Unit $unit;

    /**
     * Unit price
     */
    private float $unitPrice;

    /**
     * Total amount
     */
    private float $totalAmount;

    /**
     * Free of charge
     */
    private bool $freeOfCharge;

    /**
     * Taxes
     */
    private array $taxes;

    /**
     * Allowance charges
     */
    private ?array $allowanceCharges = [];

    /**
     * Reference price
     */
    private ?ReferencePrice $referencePrice;

    /**
     * LineItem constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize
     */
    private function initialize(array $data): void
    {
        $this->setName($data['name']);
        $this->setCode($data['code'] ?? '');
        $this->setItemType($data['item_type'] ?? '999');
        $this->setQuantity($data['quantity']);
        $this->setUnit($data['unit_code'] ?? '94');
        $this->setUnitPrice($data['unit_price']);
        $this->setTotalAmount($data['total_amount']);
        $this->setFreeOfCharge($data['free_of_charge'] ?? false);
        $this->setTaxes($data['taxes'] ?? []);
        $this->setAllowanceCharges($data['allowance_charges'] ?? []);

        // Reference price
        if (isset($data['reference_price']) && is_array($data['reference_price'])) {
            $this->setReferencePrice($data['reference_price']);
        }
    }

    /**
     * Get name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get type
     */
    public function getItemType(): LineItemType
    {
        return $this->itemType;
    }

    /**
     * Set item type
     */
    public function setItemType(string $type): void
    {
        $itemType = (new DataLoader('line-item-types'))->getByCode($type);

        $this->itemType = new LineItemType($itemType);
    }

    /**
     * Get quantity
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * Set quantity
     */
    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * Get unit
     */
    public function getUnit(): Unit
    {
        return $this->unit;
    }

    /**
     * Set unit
     */
    public function setUnit(string $unit): void
    {
        $unit = (new DataLoader('units'))->getByCode($unit);

        $this->unit = new Unit($unit);
    }

    /**
     * Get unit price
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * Set unit price
     */
    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * Get total amount
     */
    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    /**
     * Set total amount
     */
    public function setTotalAmount(float $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * Get free of charge
     */
    public function getFreeOfCharge(): bool
    {
        return $this->freeOfCharge;
    }

    /**
     * Set free of charge
     */
    public function setFreeOfCharge(bool $freeOfCharge): void
    {
        $this->freeOfCharge = $freeOfCharge;
    }

    /**
     * Get taxes
     */
    public function getTaxes(): array
    {
        return $this->taxes;
    }

    /**
     * Set taxes
     */
    public function setTaxes(array $taxes): void
    {
        foreach ($taxes as $tax) {
            $this->addTax($tax);
        }
    }

    /**
     * Add tax
     */
    public function addTax(array|Tax $tax): void
    {
        $this->taxes[] = $tax instanceof Tax ? $tax : new Tax($tax);
    }

    /**
     * Get allowance charges
     */
    public function getAllowanceCharges(): ?array
    {
        return $this->allowanceCharges;
    }

    /**
     * Set allowance charges
     */
    public function setAllowanceCharges(array $allowanceCharges): void
    {
        foreach ($allowanceCharges as $allowanceCharge) {
            $this->addAllowanceCharge($allowanceCharge);
        }
    }

    /**
     * Add allowance charge
     */
    public function addAllowanceCharge(array|AllowanceCharge $allowanceCharge): void
    {
        $this->allowanceCharges[] = $allowanceCharge instanceof AllowanceCharge ? $allowanceCharge : new AllowanceCharge($allowanceCharge);
    }

    /**
     * Get reference price
     */
    public function getReferencePrice(): ?ReferencePrice
    {
        return $this->referencePrice ?? null;
    }

    /**
     * Set reference price
     */
    public function setReferencePrice(array|ReferencePrice $referencePrice): void
    {
        $this->referencePrice = $referencePrice instanceof ReferencePrice ? $referencePrice : new ReferencePrice($referencePrice);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'code' => $this->getCode(),
            'item_type' => $this->getItemType()->toArray(),
            'quantity' => $this->getQuantity(),
            'unit' => $this->getUnit()->toArray(),
            'unit_price' => $this->getUnitPrice(),
            'total_amount' => $this->getTotalAmount(),
            'free_of_charge' => $this->getFreeOfCharge(),
            'taxes' => array_map(function (Tax $tax) {
                return $tax->toArray();
            }, $this->getTaxes()),
            'allowance_charges' => array_map(function (AllowanceCharge $allowanceCharge) {
                return $allowanceCharge->toArray();
            }, $this->getAllowanceCharges()),
            'reference_price' => $this->getReferencePrice() ? $this->getReferencePrice()->toArray() : null,
        ];
    }
}
