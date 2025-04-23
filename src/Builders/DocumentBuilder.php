<?php

namespace DazzaDev\DianXmlGenerator\Builders;

use DazzaDev\DianXmlGenerator\Enums\Environments;
use DazzaDev\DianXmlGenerator\Models\CreditNote\CreditNote;
use DazzaDev\DianXmlGenerator\Models\DebitNote\DebitNote;
use DazzaDev\DianXmlGenerator\Models\Entities\Company;
use DazzaDev\DianXmlGenerator\Models\Entities\Customer;
use DazzaDev\DianXmlGenerator\Models\Invoice\Invoice;
use DazzaDev\DianXmlGenerator\Models\Invoice\NumberingRange;
use DazzaDev\DianXmlGenerator\Models\Invoice\SupportDocument;
use DazzaDev\DianXmlGenerator\XmlHelper;
use DOMDocument;
use InvalidArgumentException;

class DocumentBuilder
{
    private string $documentType;

    private array $documentData;

    private Invoice|SupportDocument|CreditNote|DebitNote $document;

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
        $this->document->setOperationType($this->documentData['operation_type']);
        $this->document->setPrefix($this->documentData['prefix']);
        $this->document->setNumber($this->documentData['number']);
        $this->document->setDate($this->documentData['date']);

        // Only for invoices and support documents
        if ($this->document instanceof Invoice || $this->document instanceof SupportDocument) {
            // Set numbering range
            $this->setNumberingRange();
        }

        // Due date
        $dueDate = $this->documentData['due_date'] ?? null;
        if (isset($dueDate)) {
            $this->document->setDueDate($dueDate);
        }

        // Order reference
        if (isset($this->documentData['order_reference'])) {
            $this->document->setOrderReference($this->documentData['order_reference']);
        }

        // Billing Reference
        if (isset($this->documentData['billing_reference'])) {
            $this->document->setBillingReference($this->documentData['billing_reference']);
        }

        // Correction reason
        if ($this->document instanceof CreditNote || $this->document instanceof DebitNote) {
            if (isset($this->documentData['correction_reason'])) {
                $this->document->setCorrectionReason($this->documentData['correction_reason']);
            }
        }

        // Currency
        $this->document->setCurrency($this->documentData['currency']);

        // Note
        if (isset($this->documentData['note'])) {
            $this->document->setNote($this->documentData['note']);
        }

        // Payment Variables
        $paymentMean = $this->documentData['payment_mean'];
        $payments = $this->documentData['payments'] ?? [];

        // Payment mean
        $this->document->setPaymentMean($paymentMean);
        $this->document->setPaymentMeans($payments, $paymentMean, $dueDate);

        // Payments
        if (count($payments) > 0) {
            $this->document->setPayments($payments);
        }

        // Set customer
        $this->setCustomer();

        // Set company
        $this->setCompany();

        // Set line items
        $this->document->setLineItems($this->documentData['line_items']);

        // Set taxes
        $this->document->setTaxes($this->documentData['taxes']);

        // Set totals
        $this->document->setTotals($this->documentData['totals']);
    }

    /**
     * Get document model
     */
    private function documentModel(): Invoice|SupportDocument|CreditNote|DebitNote
    {
        return match ($this->documentType) {
            'invoice' => new Invoice,
            'support-document' => new SupportDocument,
            'equivalent-document' => new Invoice,
            'credit-note' => new CreditNote,
            'debit-note' => new DebitNote,
            default => throw new InvalidArgumentException("Invalid document type: $this->documentType"),
        };
    }

    /**
     * Get document
     */
    public function getDocument(): Invoice|SupportDocument|CreditNote|DebitNote
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

    /**
     * Set company
     */
    public function setCompany()
    {
        $company = new Company;
        $company->setIdentificationType($this->documentData['company']['identification_type']);
        $company->setIdentificationNumber($this->documentData['company']['identification_number']);
        $company->setEntityType($this->documentData['company']['entity_type']);
        $company->setName($this->documentData['company']['name']);
        $company->setEmail($this->documentData['company']['email']);

        // Merchant Registration
        if (isset($this->documentData['company']['merchant_registration'])) {
            $company->setMerchantRegistration($this->documentData['company']['merchant_registration']);
        }

        // Company Regime
        if (isset($this->documentData['company']['regime'])) {
            $company->setRegime($this->documentData['company']['regime']);
        }

        // Company Liability
        if (isset($this->documentData['company']['liability'])) {
            $company->setLiability($this->documentData['company']['liability']);
        }

        // Company Phone
        if (isset($this->documentData['company']['phone'])) {
            $company->setPhone($this->documentData['company']['phone']);
        }

        // Company Address
        if (isset($this->documentData['company']['address'])) {
            $company->setAddress($this->documentData['company']['address']);
        }

        // Company City
        if (isset($this->documentData['company']['city'])) {
            $company->setCity($this->documentData['company']['city']);
        }

        // Company State
        if (isset($this->documentData['company']['state'])) {
            $company->setState($this->documentData['company']['state']);
        }

        // Company Country
        if (isset($this->documentData['company']['country'])) {
            $company->setCountry($this->documentData['company']['country']);
        }

        $this->document->setCompany($company);
    }

    /**
     * Set customer
     */
    public function setCustomer()
    {
        $customer = new Customer;
        $customer->setIdentificationType($this->documentData['customer']['identification_type']);
        $customer->setIdentificationNumber($this->documentData['customer']['identification_number']);
        $customer->setEntityType($this->documentData['customer']['entity_type']);
        $customer->setName($this->documentData['customer']['name']);
        $customer->setEmail($this->documentData['customer']['email']);

        // Customer Regime
        if (isset($this->documentData['customer']['regime'])) {
            $customer->setRegime($this->documentData['customer']['regime']);
        }

        // Customer Liability
        if (isset($this->documentData['customer']['liability'])) {
            $customer->setLiability($this->documentData['customer']['liability']);
        }

        // Customer Phone
        if (isset($this->documentData['customer']['phone'])) {
            $customer->setPhone($this->documentData['customer']['phone']);
        }

        // Customer Address
        if (isset($this->documentData['customer']['address'])) {
            $customer->setAddress($this->documentData['customer']['address']);
        }

        // Customer City
        if (isset($this->documentData['customer']['city'])) {
            $customer->setCity($this->documentData['customer']['city']);
        }

        // Customer State
        if (isset($this->documentData['customer']['state'])) {
            $customer->setState($this->documentData['customer']['state']);
        }

        // Customer Country
        if (isset($this->documentData['customer']['country'])) {
            $customer->setCountry($this->documentData['customer']['country']);
        }

        $this->document->setCustomer($customer);
    }

    /**
     * Set numbering range
     */
    public function setNumberingRange()
    {
        $numberingRange = new NumberingRange;
        $numberingRange->setPrefix($this->documentData['numbering_range']['prefix']);
        $numberingRange->setAuthorizedCode($this->documentData['numbering_range']['authorized_code']);
        $numberingRange->setStartDate($this->documentData['numbering_range']['start_date']);
        $numberingRange->setEndDate($this->documentData['numbering_range']['end_date']);
        $numberingRange->setStartNumber($this->documentData['numbering_range']['start_number']);
        $numberingRange->setEndNumber($this->documentData['numbering_range']['end_number']);

        $this->document->setNumberingRange($numberingRange);
    }
}
