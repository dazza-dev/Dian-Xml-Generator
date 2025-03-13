<?php

namespace DazzaDev\DianXmlGenerator\Builders;

use DazzaDev\DianXmlGenerator\Models\AttachedDocument\AttachedDocument;
use DazzaDev\DianXmlGenerator\Models\Entities\Company;
use DazzaDev\DianXmlGenerator\Models\Entities\Customer;
use DazzaDev\DianXmlGenerator\XmlHelper;
use DOMDocument;

class AttachedDocumentBuilder
{
    private array $attachedDocumentData;

    private AttachedDocument $attachedDocument;

    public function __construct(array $attachedDocumentData)
    {
        $this->attachedDocumentData = $attachedDocumentData;
        $this->attachedDocument = new AttachedDocument;

        $this->attachedDocument->setPrefix($this->attachedDocumentData['prefix']);
        $this->attachedDocument->setNumber($this->attachedDocumentData['number']);
        $this->attachedDocument->setDate($this->attachedDocumentData['date']);
        $this->attachedDocument->setUniqueCode($this->attachedDocumentData['unique_code']);
        $this->attachedDocument->setSignedXml($this->attachedDocumentData['signed_xml']);
        $this->attachedDocument->setApplicationResponse($this->attachedDocumentData['application_response']);
        $this->setCustomer();
        $this->setCompany();
    }

    /**
     * Get attached document
     */
    public function getAttachedDocument(): AttachedDocument
    {
        return $this->attachedDocument;
    }

    /**
     * Get attached document XML
     */
    public function getXml(): DOMDocument
    {
        return (new XmlHelper)->getXml('attached', $this->attachedDocument->toArray());
    }

    /**
     * Set company
     */
    public function setCompany()
    {
        $company = new Company;
        $company->setIdentificationType($this->attachedDocumentData['company']['identification_type']);
        $company->setIdentificationNumber($this->attachedDocumentData['company']['identification_number']);
        $company->setEntityType($this->attachedDocumentData['company']['entity_type']);
        $company->setName($this->attachedDocumentData['company']['name']);
        $company->setEmail($this->attachedDocumentData['company']['email']);
        $company->setMerchantRegistration($this->attachedDocumentData['company']['merchant_registration']);

        // Company Regime
        if (isset($this->attachedDocumentData['company']['regime'])) {
            $company->setRegime($this->attachedDocumentData['company']['regime']);
        }

        // Company Liability
        if (isset($this->attachedDocumentData['company']['liability'])) {
            $company->setLiability($this->attachedDocumentData['company']['liability']);
        }

        // Company Phone
        if (isset($this->attachedDocumentData['company']['phone'])) {
            $company->setPhone($this->attachedDocumentData['company']['phone']);
        }

        // Company Address
        if (isset($this->attachedDocumentData['company']['address'])) {
            $company->setAddress($this->attachedDocumentData['company']['address']);
        }

        if (isset($this->attachedDocumentData['company']['city'])) {
            $company->setCity($this->attachedDocumentData['company']['city']);
        }

        if (isset($this->attachedDocumentData['company']['state'])) {
            $company->setState($this->attachedDocumentData['company']['state']);
        }

        $this->attachedDocument->setCompany($company);
    }

    /**
     * Set customer
     */
    public function setCustomer()
    {
        $customer = new Customer;
        $customer->setIdentificationType($this->attachedDocumentData['customer']['identification_type']);
        $customer->setIdentificationNumber($this->attachedDocumentData['customer']['identification_number']);
        $customer->setEntityType($this->attachedDocumentData['customer']['entity_type']);
        $customer->setName($this->attachedDocumentData['customer']['name']);
        $customer->setEmail($this->attachedDocumentData['customer']['email']);

        // Customer Regime
        if (isset($this->attachedDocumentData['customer']['regime'])) {
            $customer->setRegime($this->attachedDocumentData['customer']['regime']);
        }

        // Customer  Liability
        if (isset($this->attachedDocumentData['customer']['liability'])) {
            $customer->setLiability($this->attachedDocumentData['customer']['liability']);
        }

        // Customer Phone
        if (isset($this->attachedDocumentData['customer']['phone'])) {
            $customer->setPhone($this->attachedDocumentData['customer']['phone']);
        }

        // Customer Address
        if (isset($this->attachedDocumentData['customer']['address'])) {
            $customer->setAddress($this->attachedDocumentData['customer']['address']);
        }

        if (isset($this->attachedDocumentData['customer']['city'])) {
            $customer->setCity($this->attachedDocumentData['customer']['city']);
        }

        if (isset($this->attachedDocumentData['customer']['state'])) {
            $customer->setState($this->attachedDocumentData['customer']['state']);
        }

        if (isset($this->attachedDocumentData['customer']['country'])) {
            $customer->setCountry($this->attachedDocumentData['customer']['country']);
        }

        $this->attachedDocument->setCustomer($customer);
    }
}
