<?php

namespace DazzaDev\DianXmlGenerator\Models;

use DateTime;
use DazzaDev\DianXmlGenerator\DataLoader;
use DazzaDev\DianXmlGenerator\DateValidator;
use DazzaDev\DianXmlGenerator\Enums\Environments;
use DazzaDev\DianXmlGenerator\Models\Entities\Company;
use DazzaDev\DianXmlGenerator\Models\Entities\Customer;
use DazzaDev\DianXmlGenerator\Models\LineItem\LineItem;
use DazzaDev\DianXmlGenerator\Models\Payment\Payment;
use DazzaDev\DianXmlGenerator\Models\Payment\PaymentMean;
use DazzaDev\DianXmlGenerator\Models\Tax\Tax;
use DazzaDev\DianXmlGenerator\Traits\Environment;
use DazzaDev\DianXmlGenerator\Traits\TraitDocumentType;

class Document
{
    use Environment, TraitDocumentType;

    private string $profileId;

    private OperationType $operationType;

    private string $prefix;

    private string $number;

    private string $issueDate;

    private string $issueTime;

    private ?string $note;

    private Currency $currency;

    private Customer $customer;

    private ?Company $company;

    private ?BillingReference $billingReference;

    private Total $totals;

    private array $lineItems = [];

    private array $taxes = [];

    private ?PaymentMean $paymentMean;

    private array $payments = [];

    private array $paymentMeans = [];

    /**
     * Document constructor
     *
     * @param  array  $data  Document data
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize document data
     *
     * @param  array  $data  Document data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        // Environment
        if (isset($data['environment'])) {
            $this->setEnvironment(Environments::from($data['environment']));
        }

        // Software
        if (isset($data['software']) && is_array($data['software'])) {
            $this->setSoftware($data['software']);
        }

        // Operation type
        if (isset($data['operation_type'])) {
            $this->setOperationType($data['operation_type']);
        }

        // Prefix
        if (isset($data['prefix'])) {
            $this->setPrefix($data['prefix']);
        }

        // Number
        if (isset($data['number'])) {
            $this->setNumber($data['number']);
        }

        // Note
        if (isset($data['note'])) {
            $this->setNote($data['note']);
        }

        // Issue date
        if (isset($data['date'])) {
            $this->setDate($data['date']);
        }

        // Currency
        if (isset($data['currency'])) {
            $this->setCurrency($data['currency']);
        }

        // Company
        if (isset($data['company']) && is_array($data['company'])) {
            $this->setCompany($data['company']);
        }

        // Customer
        if (isset($data['customer']) && is_array($data['customer'])) {
            $this->setCustomer($data['customer']);
        }

        // Billing Reference
        if (isset($data['billing_reference']) && is_array($data['billing_reference'])) {
            $this->setBillingReference($data['billing_reference']);
        }

        // Line Items
        if (isset($data['line_items']) && is_array($data['line_items'])) {
            foreach ($data['line_items'] as $lineData) {
                $this->addLineItem(new LineItem($lineData));
            }
        }

        // Taxes
        if (isset($data['taxes']) && is_array($data['taxes'])) {
            foreach ($data['taxes'] as $taxData) {
                $this->addTax(new Tax($taxData));
            }
        }

        // Totals
        if (isset($data['totals']) && is_array($data['totals'])) {
            $this->setTotals(new Total($data['totals']));
        }

        // Payment Mean
        if (isset($data['payment_mean'])) {
            $this->setPaymentMean($data['payment_mean']);
            $this->setPaymentMeans($data['payments'], $data['payment_mean'], $data['due_date']);
        }

        // Payments
        if (isset($data['payments']) && is_array($data['payments'])) {
            $this->setPayments($data['payments']);
        }
    }

    /**
     * Get profile ID
     */
    public function getProfileId(): string
    {
        return $this->profileId;
    }

    /**
     * Set profile ID
     */
    public function setProfileId(string $profileId): void
    {
        $this->profileId = $profileId;
    }

    /**
     * Get operation type
     */
    public function getOperationType(): OperationType
    {
        return $this->operationType;
    }

    /**
     * Set operation type
     */
    public function setOperationType(string $operationTypeCode): void
    {
        $operationType = (new DataLoader('operation-types'))->getByCode($operationTypeCode);

        $this->operationType = new OperationType($operationType);
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
    public function getDate(): string
    {
        return $this->issueDate.'T'.$this->issueTime;
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
     * Get currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * Set currency
     */
    public function setCurrency(string $currencyCode): void
    {
        $currency = (new DataLoader('currencies'))->getByCode($currencyCode);

        $this->currency = new Currency($currency);
    }

    /**
     * Get note
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * Set note
     */
    public function setNote(string $note): void
    {
        $this->note = $note;
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
     * Get billing reference
     */
    public function getBillingReference(): ?BillingReference
    {
        return $this->billingReference ?? null;
    }

    /**
     * Set billing reference
     */
    public function setBillingReference(array|BillingReference $billingReference): void
    {
        $this->billingReference = $billingReference instanceof BillingReference ? $billingReference : new BillingReference($billingReference);
    }

    /**
     * Get line items
     */
    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    /**
     * Set line items
     */
    public function setLineItems(array $lineItems): void
    {
        foreach ($lineItems as $lineItem) {
            $this->addLineItem($lineItem);
        }
    }

    /**
     * Add line item
     */
    public function addLineItem(array|LineItem $lineItem): void
    {
        $this->lineItems[] = $lineItem instanceof LineItem ? $lineItem : new LineItem($lineItem);
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
     * Get totals
     */
    public function getTotals(): Total
    {
        return $this->totals;
    }

    /**
     * Set totals
     */
    public function setTotals(array|Total $totals): void
    {
        $this->totals = $totals instanceof Total ? $totals : new Total($totals);
    }

    /**
     * Get payment mean
     */
    public function getPaymentMean(): PaymentMean
    {
        return $this->paymentMean;
    }

    /**
     * Set payment mean
     */
    public function setPaymentMean(string $paymentMeanCode): void
    {
        $paymentMean = (new DataLoader('payment-means'))->getByCode($paymentMeanCode);

        $this->paymentMean = new PaymentMean($paymentMean);
    }

    /**
     * Get payment means
     */
    public function getPaymentMeans(): array
    {
        return $this->paymentMeans;
    }

    /**
     * Set payment means
     */
    public function setPaymentMeans(array $payments, string $paymentMeanCode, ?string $dueDate = null): void
    {
        $paymentMeans = [];

        // Credit invoices
        if ($paymentMeanCode == '2' && count($payments) == 0) {
            $paymentMeans[] = [
                'code' => $paymentMeanCode,
                'due_date' => $dueDate,
                'payment_method' => 10,
                'payment_reference' => null,
            ];
        } else {
            foreach ($payments as $payment) {
                $paymentMeans[] = [
                    'code' => $paymentMeanCode,
                    'due_date' => $payment['due_date'] ?? null,
                    'payment_method' => $payment['payment_method'],
                    'payment_reference' => $payment['payment_reference'],
                ];
            }
        }

        $this->paymentMeans = $paymentMeans;
    }

    /**
     * Get payments
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * Set payments
     */
    public function setPayments(array $payments): void
    {
        foreach ($payments as $payment) {
            $this->addPayment($payment);
        }
    }

    /**
     * Add payment
     */
    public function addPayment(array|Payment $payment): void
    {
        $this->payments[] = $payment instanceof Payment ? $payment : new Payment($payment);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'environment' => $this->getEnvironment(),
            'software' => $this->getSoftware()->toArray(),
            'profile_id' => $this->getProfileId(),
            'operation_type' => $this->getOperationType()->toArray(),
            'document_type' => $this->getDocumentType()->toArray(),
            'prefix' => $this->getPrefix(),
            'number' => $this->getNumber(),
            'full_number' => $this->getFullNumber(),
            'issue_date' => $this->getIssueDate(),
            'issue_time' => $this->getIssueTime(),
            'note' => $this->getNote(),
            'currency' => $this->getCurrency()->toArray(),
            'customer' => $this->getCustomer()->toArray(),
            'company' => $this->getCompany()->toArray(),
            'billing_reference' => $this->getBillingReference()?->toArray(),
            'payment_mean' => $this->getPaymentMean()->toArray(),
            'payment_means' => $this->getPaymentMeans(),
            'payments' => array_map(function (Payment $payment) {
                return $payment->toArray();
            }, $this->getPayments()),
            'line_items' => array_map(function (LineItem $lineItem) {
                return $lineItem->toArray();
            }, $this->getLineItems()),
            'taxes' => array_map(function (Tax $tax) {
                return $tax->toArray();
            }, $this->getTaxes()),
            'totals' => $this->getTotals()->toArray(),
        ];
    }
}
