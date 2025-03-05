<?php

namespace DazzaDev\DianXmlGenerator\Models\Entities;

class Person extends EntityBase
{
    /**
     * First Name
     */
    private string $firstName;

    /**
     * Last Name
     */
    private string $lastName;

    /**
     * Job Title
     */
    private string $jobTitle;

    /**
     * Department
     */
    private string $department;

    /**
     * Person constructor
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        // First Name
        $this->setFirstName($data['first_name']);

        // Last Name
        $this->setLastName($data['last_name']);

        // Job Title
        $this->setJobTitle($data['job_title']);

        // Identification number
        $this->setDepartment($data['department']);
    }

    /**
     * Get First Name
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Set First Name
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * Get Last Name
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Set Last Name
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * Get Job Title
     */
    public function getJobTitle(): string
    {
        return $this->jobTitle;
    }

    /**
     * Set Job Title
     */
    public function setJobTitle(string $jobTitle): void
    {
        $this->jobTitle = $jobTitle;
    }

    /**
     * Get Department
     */
    public function getDepartment(): string
    {
        return $this->department;
    }

    /**
     * Set Department
     */
    public function setDepartment(string $department): void
    {
        $this->department = $department;
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return parent::toArray() + [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'job_title' => $this->jobTitle,
            'department' => $this->department,
        ];
    }
}
