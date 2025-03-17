<?php

namespace DazzaDev\DianXmlGenerator\Builders;

use DazzaDev\DianXmlGenerator\Enums\Environments;
use DazzaDev\DianXmlGenerator\Models\Entities\Person;
use DazzaDev\DianXmlGenerator\Models\Entities\Receiver;
use DazzaDev\DianXmlGenerator\Models\Entities\Sender;
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

        // Set sender
        $this->setSender();

        // Set receiver
        $this->setReceiver();

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
     * Set sender
     */
    public function setSender()
    {
        $sender = new Sender;
        $sender->setIdentificationType($this->eventData['sender']['identification_type']);
        $sender->setIdentificationNumber($this->eventData['sender']['identification_number']);
        $sender->setEntityType($this->eventData['sender']['entity_type']);
        $sender->setRegime($this->eventData['sender']['regime']);
        $sender->setName($this->eventData['sender']['name']);

        $this->event->setSender($sender);
    }

    /**
     * Set receiver
     */
    public function setReceiver()
    {
        $receiver = new Receiver;
        $receiver->setIdentificationType($this->eventData['receiver']['identification_type']);
        $receiver->setIdentificationNumber($this->eventData['receiver']['identification_number']);
        $receiver->setEntityType($this->eventData['receiver']['entity_type']);
        $receiver->setRegime($this->eventData['receiver']['regime']);
        $receiver->setName($this->eventData['receiver']['name']);

        $this->event->setReceiver($receiver);
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
