<?php

namespace DazzaDev\DianXmlGenerator\Models\Invoice;

use DateTime;
use DazzaDev\DianXmlGenerator\DateValidator;
use DazzaDev\DianXmlGenerator\Models\Document;

class InvoiceBase extends Document
{
    /**
     * Numbering range
     */
    private ?NumberingRange $numberingRange = null;

    /**
     * Order reference
     */
    private ?OrderReference $orderReference = null;

    /**
     * Due date
     */
    private ?string $dueDate = null;

    /**
     * Invoice Base constructor
     */
    public function __construct(array $data = [])
    {
        // Initialize invoice data
        parent::__construct($data);

        // Initialize invoice data
        $this->initialize($data);
    }

    /**
     * Initialize invoice data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        // Order reference
        if (isset($data['order_reference']) && is_array($data['order_reference'])) {
            $this->setOrderReference($data['order_reference']);
        }

        // Due date
        if (isset($data['due_date']) && ($data['due_date'] instanceof DateTime || is_string($data['due_date']))) {
            $this->setDueDate($data['due_date']);
        }
    }

    /**
     * Get numbering range
     */
    public function getNumberingRange(): ?NumberingRange
    {
        return $this->numberingRange;
    }

    /**
     * Set numbering range
     */
    public function setNumberingRange(array|NumberingRange $numberingRange): void
    {
        $this->numberingRange = $numberingRange instanceof NumberingRange ? $numberingRange : new NumberingRange($numberingRange);
    }

    /**
     * Get order reference
     */
    public function getOrderReference(): ?OrderReference
    {
        return $this->orderReference;
    }

    /**
     * Set order reference
     */
    public function setOrderReference(array|OrderReference $orderReference): void
    {
        $this->orderReference = $orderReference instanceof OrderReference ? $orderReference : new OrderReference($orderReference);
    }

    /**
     * Get due date
     */
    public function getDueDate(): ?string
    {
        return $this->dueDate;
    }

    /**
     * Set due date
     */
    public function setDueDate(string|DateTime $dueDate): void
    {
        $dateValidator = new DateValidator;

        $this->dueDate = $dateValidator->getDate($dueDate);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return parent::toArray() + [
            'numbering_range' => $this->getNumberingRange()->toArray(),
            'order_reference' => $this->getOrderReference(),
            'due_date' => $this->getDueDate(),
        ];
    }
}
