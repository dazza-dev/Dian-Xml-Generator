<?php

namespace DazzaDev\DianXmlGenerator\Models;

class CorrectionReason
{
    /**
     * Correction reason code
     */
    private string $code;

    /**
     * Correction reason name
     */
    private string $name;

    /**
     * Correction reason constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize correction reason data
     */
    private function initialize(array $data): void
    {
        $this->setCode($data['code']);
        $this->setName($data['name']);
    }

    /**
     * Get correction reason code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set correction reason code
     */
    private function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get correction reason name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set correction reason name
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
