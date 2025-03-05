<?php

namespace DazzaDev\DianXmlGenerator\Builders;

use DazzaDev\DianXmlGenerator\Enums\Environments;
use DazzaDev\DianXmlGenerator\Models\Entities\Company;
use DazzaDev\DianXmlGenerator\Models\Entities\Customer;
use DazzaDev\DianXmlGenerator\Models\Entities\Person;
use DazzaDev\DianXmlGenerator\Models\Event\Event;
use DazzaDev\DianXmlGenerator\XmlHelper;
use DOMDocument;

class EventBuilder
{
    private string $eventCode;

    private array $eventData;

    private Event $event;

    public function __construct(string $eventCode, array $eventData, string|int $environment, array $software)
    {
        $this->eventCode = $eventCode;
        $this->eventData = $eventData;
        $this->event = new Event;

        // Environment
        $this->event->setEnvironment(Environments::from($environment));

        // Software
        $this->event->setSoftware($software);

        // Event
        $this->event->setEventType($this->eventCode);
        $this->event->setNumber($this->eventData['number']);
        $this->event->setDate($this->eventData['date']);

        // Note
        if (isset($this->eventData['note'])) {
            $this->event->setNote($this->eventData['note']);
        }

        // Document Reference
        if (isset($this->eventData['document_reference'])) {
            $this->event->setDocumentReference($this->eventData['document_reference']);
        }

        // Set customer
        $this->setCustomer();

        // Set company
        $this->setCompany();

        // Set person
        $this->setPerson();
    }

    /**
     * Get event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * Get Event XML
     */
    public function getXml(): DOMDocument
    {
        return (new XmlHelper)->getXml('event', $this->event->toArray());
    }

    /**
     * Set company
     */
    public function setCompany()
    {
        $company = new Company;
        $company->setIdentificationType($this->eventData['company']['identification_type']);
        $company->setIdentificationNumber($this->eventData['company']['identification_number']);
        $company->setRegime($this->eventData['company']['regime']);
        $company->setName($this->eventData['company']['name']);

        $this->event->setCompany($company);
    }

    /**
     * Set customer
     */
    public function setCustomer()
    {
        $customer = new Customer;
        $customer->setIdentificationType($this->eventData['customer']['identification_type']);
        $customer->setIdentificationNumber($this->eventData['customer']['identification_number']);
        $customer->setRegime($this->eventData['customer']['regime']);
        $customer->setName($this->eventData['customer']['name']);

        $this->event->setCustomer($customer);
    }

    /**
     * Set person
     */
    public function setPerson()
    {
        $person = new Person;
        $person->setIdentificationType($this->eventData['person']['identification_type']);
        $person->setIdentificationNumber($this->eventData['person']['identification_number']);
        $person->setFirstName($this->eventData['person']['first_name']);
        $person->setLastName($this->eventData['person']['last_name']);
        $person->setJobTitle($this->eventData['person']['job_title']);
        $person->setDepartment($this->eventData['person']['department']);

        $this->event->setPerson($person);
    }
}
