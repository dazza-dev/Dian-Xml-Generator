<?php

namespace DazzaDev\DianXmlGenerator\Models\Geography;

class City
{
    /**
     * Name of the city
     */
    private string $name;

    /**
     * Code of the city
     */
    private string $code;

    /**
     * City constructor
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

        $this->name = $data['name'];
        $this->code = $data['code'];
    }

    /**
     * Get city name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set city name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get city code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set city code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Convert city to array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
        ];
    }
}
