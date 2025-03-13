<?php

namespace DazzaDev\DianXmlGenerator\Models\Entities;

use DazzaDev\DianXmlGenerator\DataLoader;
use DazzaDev\DianXmlGenerator\Models\Geography\Address;
use DazzaDev\DianXmlGenerator\Models\Geography\City;
use DazzaDev\DianXmlGenerator\Models\Geography\Country;
use DazzaDev\DianXmlGenerator\Models\Geography\State;

class Entity extends EntityBase
{
    /**
     * Name
     */
    private string $name;

    /**
     * Email
     */
    private ?string $email = null;

    /**
     * Phone
     */
    private ?string $phone = null;

    /**
     * Entity type
     */
    private ?EntityType $entityType = null;

    /**
     * Liability
     */
    private ?Liability $liability = null;

    /**
     * Regime
     */
    private ?Regime $regime = null;

    /**
     * Tax scheme
     */
    private array $taxScheme = [];

    /**
     * Address
     */
    private ?Address $address = null;

    /**
     * City
     */
    private ?City $city = null;

    /**
     * State
     */
    private ?State $state = null;

    /**
     * Country
     */
    private ?Country $country = null;

    /**
     * Entity constructor
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->setData($data);
    }

    /**
     * Set data from array
     */
    private function setData(array $data): void
    {
        if (empty($data)) {
            return;
        }

        // Entity type
        $this->setEntityType($data['entity_type']);

        // Regime
        $this->setRegime($data['regime']);

        // Liability
        $this->setLiability($data['liability']);

        // Name
        $this->setName($data['name']);

        // Email
        $this->setEmail($data['email']);

        // Phone
        if (isset($data['phone']) && $data['phone'] !== '') {
            $this->setPhone($data['phone']);
        }

        // Address
        if (isset($data['address']) && $data['address'] !== '') {
            $this->setAddress($data['address']);
        }

        // City
        if (isset($data['city']) && $data['city'] !== '') {
            $this->setCity($data['city']);
        }

        // State
        if (isset($data['state']) && $data['state'] !== '') {
            $this->setState($data['state']);
        }

        // Country
        if (isset($data['country']) && $data['country'] !== '') {
            $this->setCountry($data['country']);
        }
    }

    /**
     * Get name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Get phone
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Set phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * Get entity type
     */
    public function getEntityType(): ?EntityType
    {
        return $this->entityType;
    }

    /**
     * Set entity type
     */
    public function setEntityType(int|string $entityTypeCode): void
    {
        $entityType = (new DataLoader('entity-types'))->getByCode($entityTypeCode);

        $this->entityType = new EntityType($entityType);
    }

    /**
     * Get liability
     */
    public function getLiability(): Liability
    {
        return $this->liability;
    }

    /**
     * Set liability
     */
    public function setLiability(int|string $liabilityCode): void
    {
        $liability = (new DataLoader('liabilities'))->getByCode($liabilityCode);

        $this->liability = new Liability($liability);
    }

    /**
     * Get regime
     */
    public function getRegime(): Regime
    {
        return $this->regime;
    }

    /**
     * Set regime
     */
    public function setRegime(int|string $regimeCode): void
    {
        $regime = (new DataLoader('regimes'))->getByCode($regimeCode);

        $this->calculateTaxScheme($regimeCode);

        $this->regime = new Regime($regime);
    }

    /**
     * Calculate tax scheme
     */
    private function calculateTaxScheme(string $regimeCode): void
    {
        $taxMapping = [
            '48' => ['code' => '01', 'name' => 'IVA'],
            '49' => ['code' => 'ZZ', 'name' => 'No aplica'],
            'O-06' => ['code' => '01', 'name' => 'IVA'],
            'R-99-PN' => ['code' => 'ZZ', 'name' => 'No aplica'],
        ];

        if (isset($taxMapping[$regimeCode])) {
            $this->taxScheme = $taxMapping[$regimeCode];
        }
    }

    /**
     * Get tax scheme
     */
    public function getTaxScheme(): array
    {
        return $this->taxScheme;
    }

    /**
     * Get address
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * Set address
     */
    public function setAddress(string $address): void
    {
        $this->address = new Address(['addressLine' => $address]);
    }

    /**
     * Get city
     */
    public function getCity(): ?City
    {
        return $this->city;
    }

    /**
     * Set city
     */
    public function setCity(string $cityCode): void
    {
        $city = (new DataLoader('municipalities'))->getByCode($cityCode);

        $this->city = new City($city);
    }

    /**
     * Get state
     */
    public function getState(): ?State
    {
        return $this->state;
    }

    /**
     * Set state
     */
    public function setState(string $stateCode): void
    {
        $state = (new DataLoader('states'))->getByCode($stateCode);

        $this->state = new State($state);
    }

    /**
     * Get country
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }

    /**
     * Set country
     */
    public function setCountry(string $countryCode): void
    {
        $country = (new DataLoader('countries'))->getByCode($countryCode);

        $this->country = new Country($country);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return parent::toArray() + [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'regime' => $this->regime?->toArray(),
            'tax_scheme' => $this->taxScheme,
            'entity_type' => $this->getEntityType()?->toArray(),
            'liability' => $this->liability?->toArray(),
            'address' => $this->address?->toArray(),
            'city' => $this->city?->toArray(),
            'state' => $this->state?->toArray(),
            'country' => $this->country?->toArray(),
        ];
    }
}
