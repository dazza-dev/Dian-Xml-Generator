<?php

namespace DazzaDev\DianXmlGenerator\Models;

class OperationType
{
    /**
     * Operation type code
     */
    private string $code;

    /**
     * Operation type name
     */
    private string $name;

    /**
     * Operation type constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize operation type data
     */
    private function initialize(array $data): void
    {
        $this->setCode($data['code']);
        $this->setName($data['name']);
    }

    /**
     * Get operation type code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set operation type code
     */
    private function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get operation type name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set operation type name
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
