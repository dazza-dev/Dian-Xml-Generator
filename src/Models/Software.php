<?php

namespace DazzaDev\DianXmlGenerator\Models;

class Software
{
    /**
     * Identifier
     */
    protected string $identifier;

    /**
     * Test set id
     */
    protected ?string $testSetId = null;

    /**
     * pin
     */
    protected string $pin;

    /**
     * Software constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Set software
     */
    public function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        // Set Identifier
        $this->setIdentifier($data['identifier']);

        // Set Test Set ID
        if (isset($data['test_set_id']) && ! empty($data['test_set_id'])) {
            $this->setTestSetId($data['test_set_id']);
        }

        // Set PIN
        $this->setPin($data['pin']);
    }

    /**
     * Get identifier
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * Set identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * Get test set id
     */
    public function getTestSetId(): string
    {
        return $this->testSetId;
    }

    /**
     * Set test set id
     */
    public function setTestSetId(string $testSetId): void
    {
        $this->testSetId = $testSetId;
    }

    /**
     * Get pin
     */
    public function getPin(): string
    {
        return $this->pin;
    }

    /**
     * Set pin
     */
    public function setPin(string $pin): void
    {
        $this->pin = $pin;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'identifier' => $this->identifier,
            'test_set_id' => $this->testSetId,
            'pin' => $this->pin,
        ];
    }
}
