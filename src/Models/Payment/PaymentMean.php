<?php

namespace DazzaDev\DianXmlGenerator\Models\Payment;

class PaymentMean
{
    /**
     * Payment mean code
     */
    private string $code;

    /**
     * Payment mean name
     */
    private string $name;

    /**
     * PaymentMean constructor
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
     * Get payment mean code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set payment mean code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get payment mean name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set payment mean name
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
