<?php

namespace DazzaDev\DianXmlGenerator\Builders;

use DazzaDev\DianXmlGenerator\Enums\Environments;
use DazzaDev\DianXmlGenerator\Models\AdjustmentNote\AdjustmentNote;
use DazzaDev\DianXmlGenerator\Models\Payroll\Payroll;
use DazzaDev\DianXmlGenerator\XmlHelper;
use DOMDocument;
use InvalidArgumentException;

class PayrollBuilder
{
    private string $documentType;

    private array $documentData;

    private Payroll|AdjustmentNote $document;

    public function __construct(string $documentType, array $documentData, string|int $environment, array $software)
    {
        $this->documentType = $documentType;
        $this->documentData = $documentData;

        // Determine the document type
        $this->document = $this->documentModel();

        // Environment
        $this->document->setEnvironment(Environments::from($environment));

        // Software
        $this->document->setSoftware($software);

        // Document
        /*
        $this->document->setOperationType($this->documentData['operation_type']);
        $this->document->setPrefix($this->documentData['prefix']);
        $this->document->setNumber($this->documentData['number']);
        $this->document->setDate($this->documentData['date']);
        */
    }

    /**
     * Get document model
     */
    private function documentModel(): Payroll|AdjustmentNote
    {
        return match ($this->documentType) {
            'individual-payroll' => new Payroll,
            'adjustment-note' => new AdjustmentNote,
            default => throw new InvalidArgumentException("Invalid document type: $this->documentType"),
        };
    }

    /**
     * Get document
     */
    public function getDocument(): Payroll|AdjustmentNote
    {
        return $this->document;
    }

    /**
     * Get document XML
     */
    public function getXml(): DOMDocument
    {
        return (new XmlHelper)->getXml($this->documentType, $this->document->toArray());
    }
}
