<?php

namespace DazzaDev\DianXmlGenerator\Models\Payroll;

class Payroll
{
    /**
     * Invoice constructor
     */
    public function __construct(array $data = [])
    {
        // Document type
        $this->setDocumentType('01');

        // Profile ID
        $this->setProfileId('DIAN 2.1: Factura Electrónica de Venta');

        // Initialize invoice data
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
