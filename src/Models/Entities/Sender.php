<?php

namespace DazzaDev\DianXmlGenerator\Models\Entities;

class Sender extends Entity
{
    /**
     * Sender constructor
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
