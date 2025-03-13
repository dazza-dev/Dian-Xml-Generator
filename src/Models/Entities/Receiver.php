<?php

namespace DazzaDev\DianXmlGenerator\Models\Entities;

class Receiver extends Entity
{
    /**
     * Receiver constructor
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return parent::toArray();
    }
}
