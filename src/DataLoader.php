<?php

namespace DazzaDev\DianXmlGenerator;

use DazzaDev\DianXmlGenerator\Exceptions\CodeNotFoundException;
use DazzaDev\DianXmlGenerator\Exceptions\InvalidDataException;

class DataLoader
{
    /**
     * Data folder
     */
    private string $dataFolder;

    /**
     * Data filename
     */
    private string $filename;

    /**
     * Data cache
     */
    private array $dataCache = [];

    /**
     * DataLoader constructor
     */
    public function __construct(string $filename)
    {
        $this->dataFolder = __DIR__.'/Data';
        $this->filename = $filename.'.json';
    }

    /**
     * Load data from JSON file
     */
    private function loadData(): void
    {
        $filePath = $this->dataFolder.DIRECTORY_SEPARATOR.$this->filename;

        // Verify if the file exists
        if (! file_exists($filePath)) {
            throw new InvalidDataException("El archivo '{$this->filename}' no existe en el directorio '{$this->dataFolder}'.");
        }

        $fileContents = file_get_contents($filePath);

        // Verify if the file is readable
        if ($fileContents === false) {
            throw new InvalidDataException("No se pudo leer el archivo '{$this->filename}'.");
        }

        $data = json_decode($fileContents, true);

        // Verify if the file is a valid JSON
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidDataException("Error al decodificar el archivo JSON '{$this->filename}': ".json_last_error_msg());
        }

        // Verify if the file is an array
        if (! is_array($data)) {
            throw new InvalidDataException("El archivo '{$this->filename}' debe contener un array JSON.");
        }

        // Convert the list to an associative array using 'code' as the key
        $this->dataCache[$this->filename] = [];
        foreach ($data as $item) {
            // Verify if the item has the required keys
            if (! isset($item['code']) || ! isset($item['name'])) {
                throw new InvalidDataException("Cada elemento en '{$this->filename}' debe contener las claves 'code' y 'name'.");
            }
            $this->dataCache[$this->filename][$item['code']] = $item;
        }
    }

    /**
     * Get data by code
     */
    public function getByCode(string $code): array
    {
        if (! isset($this->dataCache[$this->filename])) {
            $this->loadData();
        }

        $data = $this->dataCache[$this->filename];

        // Verify if the code exists in the data
        if (! array_key_exists($code, $data)) {
            throw new CodeNotFoundException("No se encontró el código '{$code}' en el archivo '{$this->filename}'.");
        }

        return $data[$code];
    }
}
