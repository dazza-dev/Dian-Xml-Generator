<?php

namespace DazzaDev\DianXmlGenerator\Models;

class Currency
{
    /**
     * Currency code
     */
    private string $code;

    /**
     * Currency name
     */
    private string $name;

    /**
     * Currency constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize currency data
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
     * Get currency code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set currency code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get currency name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set currency name
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
