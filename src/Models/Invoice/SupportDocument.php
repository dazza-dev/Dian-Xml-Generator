<?php

namespace DazzaDev\DianXmlGenerator\Models\Invoice;

class SupportDocument extends InvoiceBase
{
    /**
     * Invoice constructor
     */
    public function __construct(array $data = [])
    {
        // Document type
        $this->setDocumentType('05');

        // Profile ID
        $this->setProfileId('DIAN 2.1: documento soporte en adquisiciones efectuadas a no obligados a facturar.');

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
