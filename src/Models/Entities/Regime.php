<?php

namespace DazzaDev\DianXmlGenerator\Models\Entities;

class Regime
{
    /**
     * Regime code
     */
    private string $code;

    /**
     * Regime name
     */
    private string $name;

    /**
     * Regime constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize regime data
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
     * Get regime code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set regime code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get regime name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set regime name
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
