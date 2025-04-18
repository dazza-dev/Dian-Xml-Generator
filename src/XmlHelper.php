<?php

namespace DazzaDev\DianXmlGenerator;

use DazzaDev\DianXmlGenerator\Exceptions\XmlException;
use DOMDocument;
use Exception;
use InvalidArgumentException;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class XmlHelper
{
    /**
     * Convert view to DOMDocument
     */
    public function getXml(string $view, array $data): DOMDocument
    {
        $loader = new FilesystemLoader(__DIR__.'/Views');
        $twig = new Environment($loader);
        $xml = $twig->render($view.'.xml.twig', $data);

        return $this->convertToDOMDocument($xml);
    }

    /**
     * Convert XML string to DOMDocument
     */
    public function convertToDOMDocument(string $xml)
    {
        try {
            $DOMDocumentXML = new DOMDocument;
            $DOMDocumentXML->preserveWhiteSpace = false;
            $DOMDocumentXML->formatOutput = true;
            $DOMDocumentXML->loadXML($xml);

            return $DOMDocumentXML;
        } catch (InvalidArgumentException $e) {
            throw new XmlException("The API does not support the type of document. Error: {$e->getMessage()}");
        } catch (Exception $e) {
            throw new XmlException('Error converting to DOMDocument: '.$e->getMessage());
        }
    }
}
