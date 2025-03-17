<?php

namespace DazzaDev\DianXmlGenerator\Models\Entities;

class IdentificationType
{
    /**
     * Identification type code
     */
    private string $code;

    /**
     * Identification type name
     */
    private string $name;

    /**
     * Identification type constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize identification type data
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
     * Get identification type code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set identification type code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get identification type name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set identification type name
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
            'code' => $this->getCode(),
            'name' => $this->getName(),
        ];
    }
}
