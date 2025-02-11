<?php

namespace DazzaDev\DianXmlGenerator\Models\Payment;

class PaymentMethod
{
    /**
     * Payment method code
     */
    private string $code;

    /**
     * Payment method name
     */
    private string $name;

    /**
     * PaymentMethod constructor
     */
    public function __construct(array $data = [])
    {
        if (empty($data)) {
            return;
        }

        $this->setCode($data['code']);
        $this->setName($data['name']);
    }

    /**
     * Get payment method code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set payment method code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get payment method name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set payment method name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
        ];
    }
}
