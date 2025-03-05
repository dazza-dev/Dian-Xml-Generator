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
     * Entity type
     */
    private EntityType $entityType;

    /**
     * Liability
     */
    private Liability $liability;

    /**
     * Name
     */
    private string $name;

    /**
     * Email
     */
    private string $email;

    /**
     * Phone
     */
    private string $phone;

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

        // Liability
        $this->setLiability($data['liability']);

        // Name
        $this->setName($data['name']);

        // Email
        $this->setEmail($data['email']);

        // Phone
        $this->setPhone($data['phone']);

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
     * Get entity type
     */
    public function getEntityType(): EntityType
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
            'entity_type' => $this->entityType?->toArray(),
            'liability' => $this->liability?->toArray(),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address?->toArray(),
            'city' => $this->city?->toArray(),
            'state' => $this->state?->toArray(),
            'country' => $this->country?->toArray(),
        ];
    }
}
