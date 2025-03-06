<?php

namespace DazzaDev\DianXmlGenerator\Models\Event;

use DateTime;
use DazzaDev\DianXmlGenerator\DataLoader;
use DazzaDev\DianXmlGenerator\DateValidator;
use DazzaDev\DianXmlGenerator\Enums\Environments;
use DazzaDev\DianXmlGenerator\Models\Entities\Person;
use DazzaDev\DianXmlGenerator\Models\Entities\Receiver;
use DazzaDev\DianXmlGenerator\Models\Entities\Sender;
use DazzaDev\DianXmlGenerator\Traits\Environment;
use DazzaDev\DianXmlGenerator\Traits\TraitDocumentType;

class Event
{
    use Environment, TraitDocumentType;

    /**
     * Number
     */
    private string $number;

    /**
     * Issue date
     */
    private string $issueDate;

    /**
     * Issue time
     */
    private string $issueTime;

    /**
     * Note
     */
    private string $note;

    /**
     * Sender
     */
    private Sender $sender;

    /**
     * Receiver
     */
    private Receiver $receiver;

    /**
     * Person
     */
    private Person $person;

    /**
     * Document Reference
     */
    private DocumentReference $documentReference;

    /**
     * Event Type
     */
    private EventType $eventType;

    /**
     * Event constructor
     */
    public function __construct(array $data = [])
    {
        $this->setDocumentType('96');
        $this->initialize($data);
    }

    /**
     * Initialize event data
     */
    private function initialize(array $data): void
    {
        if (empty($data)) {
            return;
        }

        // Environment
        if (isset($data['environment'])) {
            $this->setEnvironment(Environments::from($data['environment']));
        }

        // Software
        if (isset($data['software']) && is_array($data['software'])) {
            $this->setSoftware($data['software']);
        }

        // Number
        $this->setNumber($data['number']);

        // Issue date
        $this->setDate($data['date']);

        // Note
        $this->setNote($data['note']);

        // Event Type
        $this->setEventType($data['event_type']);

        // Document Reference
        $this->setDocumentReference($data['document_reference']);

        // Sender
        $this->setSender($data['sender']);

        // Receiver
        $this->setReceiver($data['receiver']);

        // Person
        $this->setPerson($data['person']);
    }

    /**
     * Get number
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * Set number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * Set date
     */
    public function setDate(string|DateTime $date): void
    {
        $dateValidator = new DateValidator;

        $this->setIssueDate($dateValidator->getDate($date));
        $this->setIssueTime($dateValidator->getTime($date));
    }

    /**
     * Get issue date
     */
    public function getIssueDate(): string
    {
        return $this->issueDate;
    }

    /**
     * Set issue date
     */
    public function setIssueDate(string $issueDate): void
    {
        $this->issueDate = $issueDate;
    }

    /**
     * Get issue time
     */
    public function getIssueTime(): string
    {
        return $this->issueTime;
    }

    /**
     * Set issue time
     */
    public function setIssueTime(string $issueTime): void
    {
        $this->issueTime = $issueTime;
    }

    /**
     * Get Note
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * Set Note
     */
    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    /**
     * Get Event Type
     */
    public function getEventType(): EventType
    {
        return $this->eventType;
    }

    /**
     * Set Event Type
     */
    public function setEventType(string $eventTypeCode): void
    {
        $eventType = (new DataLoader('events'))->getByCode($eventTypeCode);

        $this->eventType = new EventType($eventType);
    }

    /**
     * Get Document Reference
     */
    public function getDocumentReference(): DocumentReference
    {
        return $this->documentReference;
    }

    /**
     * Set Document Reference
     */
    public function setDocumentReference(array|DocumentReference $documentReference): void
    {
        $this->documentReference = $documentReference instanceof DocumentReference ? $documentReference : new DocumentReference($documentReference);
    }

    /**
     * Get sender
     */
    public function getSender(): Sender
    {
        return $this->sender;
    }

    /**
     * Set sender
     */
    public function setSender(array|Sender $sender): void
    {
        $this->sender = $sender instanceof Sender ? $sender : new Sender($sender);
    }

    /**
     * Get receiver
     */
    public function getReceiver(): Receiver
    {
        return $this->receiver;
    }

    /**
     * Set receiver
     */
    public function setReceiver(array|Receiver $receiver): void
    {
        $this->receiver = $receiver instanceof Receiver ? $receiver : new Receiver($receiver);
    }

    /**
     * Get person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * Set person
     */
    public function setPerson(array|Person $person): void
    {
        $this->person = $person instanceof Person ? $person : new Person($person);
    }

    /**
     * Get array representation
     */
    public function toArray(): array
    {
        return [
            'environment' => $this->getEnvironment(),
            'software' => $this->getSoftware()->toArray(),
            'document_type' => $this->getDocumentType()->toArray(),
            'number' => $this->number,
            'issue_date' => $this->issueDate,
            'issue_time' => $this->issueTime,
            'note' => $this->note,
            'event_type' => $this->eventType->toArray(),
            'document_reference' => $this->documentReference->toArray(),
            'sender' => $this->sender->toArray(),
            'receiver' => $this->receiver->toArray(),
            'person' => $this->person->toArray(),
        ];
    }
}
