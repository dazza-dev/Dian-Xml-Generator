<?php

namespace DazzaDev\DianXmlGenerator\Models\Entities;

class EntityType
{
    /**
     * Entity type code
     */
    private string $code;

    /**
     * Entity type name
     */
    private string $name;

    /**
     * Entity type constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize entity type data
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
     * Get entity type code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set entity type code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get entity type name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set entity type name
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
