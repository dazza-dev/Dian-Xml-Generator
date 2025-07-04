<?php

namespace DazzaDev\DianXmlGenerator\Models\Payroll\Earnings\Disabilities;

class DisabilityType
{
    /**
     * Disability type code
     */
    private string $code;

    /**
     * Disability type name
     */
    private string $name;

    /**
     * Disability type constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize disability type data
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
     * Get disability type code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set disability type code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get disability type name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set disability type name
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
