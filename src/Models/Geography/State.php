<?php

namespace DazzaDev\DianXmlGenerator\Models\Geography;

class State
{
    /**
     * Name of the state
     */
    private string $name;

    /**
     * Code of the state
     */
    private string $code;

    /**
     * State constructor
     */
    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    /**
     * Set data from array
     */
    private function setData(array $data): void
    {
        if (empty($data)) {
            return;
        }

        $this->name = $data['name'] ?? null;
        $this->code = $data['code'] ?? null;
    }

    /**
     * Get state name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set state name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get state code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set state code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Convert state to array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
        ];
    }
}
