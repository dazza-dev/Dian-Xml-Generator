<?php

namespace DazzaDev\DianXmlGenerator\Models\Invoice;

class NumberingRange
{
    /**
     * Authorized code
     */
    private string $authorizedCode;

    /**
     * Prefix
     */
    private string $prefix;

    /**
     * Start date
     */
    private string $startDate;

    /**
     * End date
     */
    private string $endDate;

    /**
     * Start number
     */
    private string $startNumber;

    /**
     * End number
     */
    private string $endNumber;

    /**
     * Numbering range constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize numbering range data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        $this->setPrefix($data['prefix']);
        $this->setAuthorizedCode($data['authorized_code']);
        $this->setStartDate($data['start_date']);
        $this->setEndDate($data['end_date']);
        $this->setStartNumber($data['start_number']);
        $this->setEndNumber($data['end_number']);
    }

    /**
     * Get prefix
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * Set prefix
     */
    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * Get authorized code
     */
    public function getAuthorizedCode(): string
    {
        return $this->authorizedCode;
    }

    /**
     * Set authorized code
     */
    public function setAuthorizedCode(string $authorizedCode): void
    {
        $this->authorizedCode = $authorizedCode;
    }

    /**
     * Get start date
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * Set start date
     */
    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * Get end date
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * Set end date
     */
    public function setEndDate(string $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * Get start number
     */
    public function getStartNumber(): string
    {
        return $this->startNumber;
    }

    /**
     * Set start number
     */
    public function setStartNumber(string $startNumber): void
    {
        $this->startNumber = $startNumber;
    }

    /**
     * Get end number
     */
    public function getEndNumber(): string
    {
        return $this->endNumber;
    }

    /**
     * Set end number
     */
    public function setEndNumber(string $endNumber): void
    {
        $this->endNumber = $endNumber;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'authorized_code' => $this->getAuthorizedCode(),
            'prefix' => $this->getPrefix(),
            'start_date' => $this->getStartDate(),
            'end_date' => $this->getEndDate(),
            'start_number' => $this->getStartNumber(),
            'end_number' => $this->getEndNumber(),
        ];
    }
}
