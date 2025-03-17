<?php

namespace DazzaDev\DianXmlGenerator\Models\AllowanceCharge;

class AllowanceChargeReason
{
    /**
     * Allowance charge reason code
     */
    private string $code;

    /**
     * Allowance charge reason name
     */
    private string $name;

    /**
     * Allowance charge reason constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize allowance charge reason data
     */
    private function initialize(array $data): void
    {
        $this->setCode($data['code']);
        $this->setName($data['name']);
    }

    /**
     * Get allowance charge reason code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set allowance charge reason code
     */
    private function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get allowance charge reason name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set allowance charge reason name
     */
    private function setName(string $name): void
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
