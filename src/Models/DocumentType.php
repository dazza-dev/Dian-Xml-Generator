<?php

namespace DazzaDev\DianXmlGenerator\Models;

class DocumentType
{
    /**
     * Document type code
     */
    private string $code;

    /**
     * Document type name
     */
    private string $name;

    /**
     * Hash type
     */
    private string $hashType;

    /**
     * Code type
     */
    private string $codeType;

    /**
     * Document type constructor
     */
    public function __construct(array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * Initialize document type data
     */
    private function initialize(array $data): void
    {
        $this->setCode($data['code']);
        $this->setName($data['name']);
        $this->setHashType($data['hash_type']);
        $this->setCodeType($data['code_type']);
    }

    /**
     * Get document type code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set document type code
     */
    private function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Get document type name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set document type name
     */
    private function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get hash type
     */
    public function getHashType(): string
    {
        return $this->hashType;
    }

    /**
     * Set hash type
     */
    private function setHashType(string $hashType): void
    {
        $this->hashType = $hashType;
    }

    /**
     * Get code type
     */
    public function getCodeType(): string
    {
        return $this->codeType;
    }

    /**
     * Set code type
     */
    private function setCodeType(string $codeType): void
    {
        $this->codeType = $codeType;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'hash_type' => $this->hashType,
            'code_type' => $this->codeType,
        ];
    }
}
