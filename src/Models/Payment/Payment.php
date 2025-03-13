<?php

namespace DazzaDev\DianXmlGenerator\Models\Payment;

use DateTime;
use DazzaDev\DianXmlGenerator\DataLoader;
use DazzaDev\DianXmlGenerator\DateValidator;

class Payment
{
    /**
     * Payment amount
     */
    private ?float $amount = null;

    /**
     * Payment received date
     */
    private ?string $receivedDate = null;

    /**
     * Payment paid date
     */
    private ?string $paidDate = null;

    /**
     * Payment paid time
     */
    private ?string $paidTime = null;

    /**
     * Payment due date
     */
    private ?string $dueDate = null;

    /**
     * Payment method
     */
    private PaymentMethod $paymentMethod;

    /**
     * Payment reference
     */
    private ?string $paymentReference = null;

    /**
     * Payment constructor
     */
    public function __construct(array $data = [])
    {
        if (empty($data)) {
            return;
        }

        //
        if (isset($data['amount'])) {
            $this->setAmount($data['amount']);
        }

        // Received Date
        if (isset($data['received_date'])) {
            $this->setReceivedDate($data['received_date']);
        }

        // Paid Date
        if (isset($data['paid_date'])) {
            $this->setPaidDate($data['paid_date']);
        }

        // Due date
        if (isset($data['due_date'])) {
            $this->setDueDate($data['due_date']);
        }

        // Payment method
        $this->setPaymentMethod($data['payment_method']);

        // Payment reference
        if (isset($data['payment_reference'])) {
            $this->setPaymentReference($data['payment_reference']);
        }
    }

    /**
     * Get payment amount
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * Set payment amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * Get payment method name
     */
    public function getReceivedDate(): ?string
    {
        return $this->receivedDate;
    }

    /**
     * Set payment method name
     */
    public function setReceivedDate(string $receivedDate): void
    {
        $dateValidator = new DateValidator;

        $this->receivedDate = $dateValidator->getDate($receivedDate);
    }

    /**
     * Get payment paid date
     */
    public function getPaidDate(): ?string
    {
        return $this->paidDate;
    }

    /**
     * Set payment paid date
     */
    public function setPaidDate(string|DateTime $paidDate): void
    {
        $dateValidator = new DateValidator;

        $this->paidDate = $dateValidator->getDate($paidDate);
        $this->paidTime = $dateValidator->getTime($paidDate);
    }

    /**
     * Get payment due date
     */
    public function getDueDate(): ?string
    {
        return $this->dueDate;
    }

    /**
     * Set payment due date
     */
    public function setDueDate(string|DateTime $dueDate): void
    {
        $dateValidator = new DateValidator;

        $this->dueDate = $dateValidator->getDate($dueDate);
    }

    /**
     * Get payment method
     */
    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * Set payment method
     */
    public function setPaymentMethod(string $paymentMethod): void
    {
        $paymentMethod = (new DataLoader('payment-methods'))->getByCode($paymentMethod);

        $this->paymentMethod = new PaymentMethod($paymentMethod);
    }

    /**
     * Get payment reference
     */
    public function getPaymentReference(): ?string
    {
        return $this->paymentReference;
    }

    /**
     * Set payment reference
     */
    public function setPaymentReference(string $paymentReference): void
    {
        $this->paymentReference = $paymentReference;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'received_date' => $this->receivedDate,
            'paid_date' => $this->paidDate,
            'paid_time' => $this->paidTime,
            'due_date' => $this->dueDate ?? null,
            'payment_method' => $this->paymentMethod->toArray(),
            'payment_reference' => $this->paymentReference,
        ];
    }
}
