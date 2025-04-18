<?php

namespace DazzaDev\DianXmlGenerator\Models\LineItem;

class Unit
{
    /**
     * Unit code
     */
    private string $code;

    /**
     * Unit name
     */
    private string $name;

    /**
     * Unit constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize unit data
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
     * Get unit code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set unit code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get unit name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set unit name
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
