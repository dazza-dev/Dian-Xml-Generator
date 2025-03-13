<?php

namespace DazzaDev\DianXmlGenerator\Models\Event;

use DazzaDev\DianXmlGenerator\DataLoader;
use DazzaDev\DianXmlGenerator\Models\DocumentType;

class DocumentReference
{
    /**
     * Number: Prefijo y Número del documento orden referenciado
     */
    private string $number;

    /**
     * Unique Identifier: CUFE/CUDE
     */
    private string $uniqueIdentifier;

    /**
     * Document Type
     */
    private DocumentType $documentType;

    /**
     * Document reference constructor
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
        $this->setNumber($data['number']);
        $this->setUniqueIdentifier($data['unique_identifier']);
        $this->setDocumentType($data['document_type']);
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
     * Get Unique Id
     */
    public function getUniqueIdentifier(): string
    {
        return $this->uniqueIdentifier;
    }

    /**
     * Set Unique Id
     */
    public function setUniqueIdentifier(string $uniqueIdentifier): void
    {
        $this->uniqueIdentifier = $uniqueIdentifier;
    }

    /**
     * Get the document type
     */
    public function getDocumentType(): DocumentType
    {
        return $this->documentType;
    }

    /**
     * Set the document type
     */
    public function setDocumentType(string $documentTypeCode): void
    {
        $documentType = (new DataLoader('document-types'))->getByCode($documentTypeCode);

        $this->documentType = new DocumentType($documentType);
    }

    /**
     * Convert document reference to array
     */
    public function toArray(): array
    {
        return [
            'number' => $this->number,
            'unique_identifier' => $this->uniqueIdentifier,
            'document_type' => $this->documentType->toArray(),
        ];
    }
}
