<?php

namespace DazzaDev\DianXmlGenerator\Models\Invoice;

class OrderReference
{
    /**
     * Number: Prefijo y Número del documento orden referenciado
     */
    private string $number;

    /**
     * Issue date: Fecha de emisión: Fecha de emisión de la orden
     */
    private ?string $issueDate;

    /**
     * Order reference constructor
     * Grupo de campos para información que describen una orden de pedido para esta factura
     * Se utiliza cuando se requiera referenciar una sola orden de pedido a la factura realizada.
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
        $this->number = $data['number'];
        $this->issueDate = $data['issue_date'] ?? null;
    }

    /**
     * Get number
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * Set number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * Get issue date
     */
    public function getIssueDate(): ?string
    {
        return $this->issueDate;
    }

    /**
     * Set issue date
     */
    public function setIssueDate(string $issueDate): void
    {
        $this->issueDate = $issueDate;
    }

    /**
     * Convert order reference to array
     */
    public function toArray(): array
    {
        return [
            'number' => $this->number,
            'issue_date' => $this->issueDate,
        ];
    }
}
