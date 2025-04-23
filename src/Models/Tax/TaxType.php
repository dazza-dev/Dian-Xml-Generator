<?php

namespace DazzaDev\DianXmlGenerator\Models\Tax;

class TaxType
{
    /**
     * Tax Code
     */
    private string $code;

    /**
     * Tax Name
     */
    private string $name;

    /**
     * Tax Type constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize tax data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        $this->setCode($data['code']);
        $this->setName($data['name']);
    }

    /**
     * Get code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set code
     */
    public function setCode(string $code): void
    {
        $this->code = trim($code);
    }

    /**
     * Get percent
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set percent
     */
    public function setName(string $name): void
    {
        $this->name = trim($name);
    }

    /**
     * Convert tax type to array
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
        ];
    }
}
