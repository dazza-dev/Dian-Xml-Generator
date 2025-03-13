<?php

namespace DazzaDev\DianXmlGenerator\Models\DebitNote;

use DazzaDev\DianXmlGenerator\DataLoader;
use DazzaDev\DianXmlGenerator\Models\CorrectionReason;
use DazzaDev\DianXmlGenerator\Models\Document;

class DebitNote extends Document
{
    /**
     * Correction reason
     */
    private CorrectionReason $correctionReason;

    /**
     * DebitNote constructor
     */
    public function __construct(array $data = [])
    {
        // Document type
        $this->setDocumentType('92');
        $this->setProfileId('DIAN 2.1: Nota Débito de Factura Electrónica de Venta');

        // Initialize debit note data
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
        $correctionReason = (new DataLoader('debit-note-corrections'))->getByCode($correctionReasonCode);

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
