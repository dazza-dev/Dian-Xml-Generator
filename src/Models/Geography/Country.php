<?php

namespace DazzaDev\DianXmlGenerator\Models\Geography;

class Country
{
    /**
     * Name of the country
     */
    private string $name;

    /**
     * Code of the country
     */
    private string $code;

    /**
     * Country constructor
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
     * Get country name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set country name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get country code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set country code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Convert country to array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
        ];
    }
}
