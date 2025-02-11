<?php

namespace DazzaDev\DianXmlGenerator\Models;

use DateTime;
use DazzaDev\DianXmlGenerator\DataLoader;
use DazzaDev\DianXmlGenerator\DateValidator;

class BillingReference
{
    /**
     * Prefix
     */
    private string $prefix;

    /**
     * Number
     */
    private string $number;

    /**
     * Unique identifier
     */
    private string $uniqueIdentifier;

    /**
     * Document type
     */
    private DocumentType $documentType;

    /**
     * Issue date
     */
    private string $issueDate;

    /**
     * Issue time
     */
    private string $issueTime;

    /**
     * BillingReference constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize billing reference data
     */
    public function initialize(array $data = [])
    {
        if (isset($data['prefix'])) {
            $this->setPrefix($data['prefix']);
        }
        if (isset($data['number'])) {
            $this->setNumber($data['number']);
        }
        if (isset($data['unique_identifier'])) {
            $this->setUniqueIdentifier($data['unique_identifier']);
        }
        if (isset($data['document_type'])) {
            $this->setDocumentType($data['document_type']);
        }
        if (isset($data['issue_date'])) {
            $this->setIssueDate($data['issue_date']);
        }
    }

    /**
     * Get the prefix
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * Set the prefix
     */
    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * Get the number
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * Set the number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * Get the unique identifier
     */
    public function getUniqueIdentifier(): string
    {
        return $this->uniqueIdentifier;
    }

    /**
     * Set the unique identifier
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
     * Get the issue date
     */
    public function getIssueDate(): string
    {
        return $this->issueDate;
    }

    /**
     * Get the issue time
     */
    public function getIssueTime(): string
    {
        return $this->issueTime;
    }

    /**
     * Set the issue date
     */
    public function setIssueDate(string|DateTime $date): void
    {
        $dateValidator = new DateValidator;

        $this->issueDate = $dateValidator->getDate($date);
        $this->issueTime = $dateValidator->getTime($date);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'prefix' => $this->prefix,
            'number' => $this->number,
            'unique_identifier' => $this->uniqueIdentifier,
            'document_type' => $this->documentType->toArray(),
            'issue_date' => $this->issueDate,
            'issue_time' => $this->issueTime,
        ];
    }
}
