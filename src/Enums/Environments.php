<?php

namespace DazzaDev\DianXmlGenerator\Enums;

enum Environments: string
{
    case PRODUCTION = '1';
    case TEST = '2';

    /**
     * Returns the display name for the environment
     */
    public function name(): string
    {
        return match ($this) {
            self::PRODUCTION => 'Producción',
            self::TEST => 'Pruebas',
        };
    }

    /**
     * Get the environment as an array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name(),
            'code' => $this->value,
            'catalog_url' => $this->getCatalogUrl(),
            'qr_url' => $this->getQrUrl(),
            'service_url' => $this->getServiceUrl(),
        ];
    }

    /**
     * Get all environments as an array with their details
     */
    public static function getEnvironments(): array
    {
        return array_reduce(self::cases(), function ($carry, self $case) {
            $carry[$case->value] = [
                'label' => $case->name(),
                'code' => $case->value,
                'catalog_url' => $case->getCatalogUrl(),
                'qr_url' => $case->getQrUrl(),
                'service_url' => $case->getServiceUrl(),
            ];

            return $carry;
        }, []);
    }

    /**
     * Check if environment is test
     */
    public function isTest(): bool
    {
        return $this === self::TEST;
    }

    /**
     * Check if environment is production
     */
    public function isProduction(): bool
    {
        return $this === self::PRODUCTION;
    }

    /**
     * Get the catalog URL for this environment
     */
    public function getCatalogUrl(): string
    {
        return match ($this) {
            self::PRODUCTION => 'https://catalogo-vpfe.dian.gov.co',
            self::TEST => 'https://catalogo-vpfe-hab.dian.gov.co',
        };
    }

    /**
     * Get the QR URL for this environment
     */
    public function getQrUrl(): string
    {
        return match ($this) {
            self::PRODUCTION => 'https://catalogo-vpfe.dian.gov.co/document/searchqr?documentkey=CUFE',
            self::TEST => 'https://catalogo-vpfe-hab.dian.gov.co/document/searchqr?documentkey=CUFE',
        };
    }

    /**
     * Get the service URL for this environment
     */
    public function getServiceUrl(): string
    {
        return match ($this) {
            self::PRODUCTION => 'https://vpfe.dian.gov.co/WcfDianCustomerServices.svc',
            self::TEST => 'https://vpfe-hab.dian.gov.co/WcfDianCustomerServices.svc',
        };
    }
}
