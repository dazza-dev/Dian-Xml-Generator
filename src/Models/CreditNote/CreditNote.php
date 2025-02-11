<?php

namespace DazzaDev\DianXmlGenerator\Models\CreditNote;

use DazzaDev\DianXmlGenerator\DataLoader;
use DazzaDev\DianXmlGenerator\Models\CorrectionReason;
use DazzaDev\DianXmlGenerator\Models\Document;

class CreditNote extends Document
{
    /**
     * Correction reason
     */
    private CorrectionReason $correctionReason;

    /**
     * CreditNote constructor
     */
    public function __construct(array $data = [])
    {
        // Document type
        $this->setDocumentType('91');
        $this->setProfileId('DIAN 2.1: Nota Crédito de Factura Electrónica de Venta');

        // Initialize credit note data
        parent::__construct($data);

        // Correction reason
        if (isset($data['correction_reason'])) {
            $this->setCorrectionReason($data['correction_reason']);
        }
    }

    /**
     * Get correction reason
     */
    public function getCorrectionReason(): CorrectionReason
    {
        return $this->correctionReason;
    }

    /**
     * Set correction reason
     */
    public function setCorrectionReason(string $correctionReasonCode): void
    {
        $correctionReason = (new DataLoader('credit-note-corrections'))->getByCode($correctionReasonCode);

        $this->correctionReason = new CorrectionReason($correctionReason);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'correction_reason' => $this->correctionReason?->toArray(),
        ]);
    }
}
