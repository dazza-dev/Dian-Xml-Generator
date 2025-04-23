<?php

namespace DazzaDev\DianXmlGenerator\Models\AttachedDocument;

use DateTime;
use DazzaDev\DianXmlGenerator\DateValidator;
use DazzaDev\DianXmlGenerator\Models\Entities\Company;
use DazzaDev\DianXmlGenerator\Models\Entities\Customer;

class AttachedDocument
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
     * Issue date
     */
    private string $issueDate;

    /**
     * Issue time
     */
    private string $issueTime;

    /**
     * Customer
     */
    private Customer $customer;

    /**
     * Company
     */
    private ?Company $company;

    /**
     * Unique code
     */
    private string $uniqueCode;

    /**
     * Signed XML
     */
    private string $signedXml;

    /**
     * Application response
     */
    private string $applicationResponse;

    /**
     * Attached document constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize attached document data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        // Prefix
        if (isset($data['prefix'])) {
            $this->setPrefix($data['prefix']);
        }

        // Number
        if (isset($data['number'])) {
            $this->setNumber($data['number']);
        }

        // Issue date
        if (isset($data['date'])) {
            $this->setDate($data['date']);
        }

        // Company
        if (isset($data['company']) && is_array($data['company'])) {
            $this->setCompany($data['company']);
        }

        // Customer
        if (isset($data['customer']) && is_array($data['customer'])) {
            $this->setCustomer($data['customer']);
        }

        // Unique code
        if (isset($data['unique_code']) && is_string($data['unique_code'])) {
            $this->setUniqueCode($data['unique_code']);
        }

        // Signed XML
        if (isset($data['signed_xml']) && is_string($data['signed_xml'])) {
            $this->setSignedXml($data['signed_xml']);
        }

        // Application response
        if (isset($data['application_response']) && is_string($data['application_response'])) {
            $this->setApplicationResponse($data['application_response']);
        }
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
     * Get full number
     */
    public function getFullNumber(): string
    {
        return $this->prefix.$this->number;
    }

    /**
     * Set date
     */
    public function setDate(string|DateTime $date): void
    {
        $dateValidator = new DateValidator;

        $this->setIssueDate($dateValidator->getDate($date));
        $this->setIssueTime($dateValidator->getTime($date));
    }

    /**
     * Get date
     */
    public function getIssueDate(): string
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
     * Get issue time
     */
    public function getIssueTime(): string
    {
        return $this->issueTime;
    }

    /**
     * Set issue time
     */
    public function setIssueTime(string $issueTime): void
    {
        $this->issueTime = $issueTime;
    }

    /**
     * Get customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * Set customer
     */
    public function setCustomer(array|Customer $customer): void
    {
        $this->customer = $customer instanceof Customer ? $customer : new Customer($customer);
    }

    /**
     * Get company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * Set company
     */
    public function setCompany(array|Company $company): void
    {
        $this->company = $company instanceof Company ? $company : new Company($company);
    }

    /**
     * Get CUFE/CUDE
     */
    public function getUniqueCode(): string
    {
        return $this->uniqueCode;
    }

    /**
     * Set CUFE/CUDE
     */
    public function setUniqueCode(string $uniqueCode): void
    {
        $this->uniqueCode = $uniqueCode;
    }

    /**
     * Get signed XML
     */
    public function getSignedXml(): string
    {
        return $this->signedXml;
    }

    /**
     * Set signed XML
     */
    public function setSignedXml(string $signedXml): void
    {
        $this->signedXml = $signedXml;
    }

    /**
     * Get application response
     */
    public function getApplicationResponse(): string
    {
        return $this->applicationResponse;
    }

    /**
     * Set application response
     */
    public function setApplicationResponse(string $applicationResponse): void
    {
        $this->applicationResponse = $applicationResponse;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'prefix' => $this->prefix,
            'number' => $this->number,
            'issue_date' => $this->issueDate,
            'issue_time' => $this->issueTime,
            'customer' => $this->customer->toArray(),
            'company' => $this->company->toArray(),
            'unique_code' => $this->uniqueCode,
            'signed_xml' => $this->signedXml,
            'application_response' => $this->applicationResponse,
        ];
    }
}
