<?php

namespace DazzaDev\DianXmlGenerator\Models\LineItem;

class LineItemType
{
    /**
     * code
     */
    private string $code;

    /**
     * name
     */
    private string $name;

    /**
     * Agency id
     */
    private string $agencyId;

    /**
     * Line item type constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize line item type data
     */
    private function initialize(array $data): void
    {
        $this->setCode($data['code']);
        $this->setName($data['name']);

        if (isset($data['agency_id'])) {
            $this->setAgencyId($data['agency_id']);
        }
    }

    /**
     * Get line item type code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set line item type code
     */
    private function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get line item type name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set line item type name
     */
    private function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get agency id
     */
    public function getAgencyId(): string
    {
        return $this->agencyId;
    }

    /**
     * Set agency id
     */
    private function setAgencyId(string $agencyId): void
    {
        $this->agencyId = $agencyId;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'name' => $this->getName(),
            'agency_id' => $this->getAgencyId(),
        ];
    }
}
