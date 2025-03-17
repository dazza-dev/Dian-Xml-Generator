<?php

namespace DazzaDev\DianXmlGenerator\Models\Entities;

class Liability
{
    /**
     * Liability code
     */
    private string $code;

    /**
     * Liability name
     */
    private string $name;

    /**
     * Liability constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize liability data
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
     * Get liability code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set liability code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get liability name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set liability name
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
