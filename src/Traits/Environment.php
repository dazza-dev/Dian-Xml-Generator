<?php

namespace DazzaDev\DianXmlGenerator\Traits;

use DazzaDev\DianXmlGenerator\Enums\Environments;
use DazzaDev\DianXmlGenerator\Models\Software;

trait Environment
{
    private array $environment;

    private Software $software;

    /**
     * Get Software
     */
    public function getSoftware(): Software
    {
        return $this->software;
    }

    /**
     * Set Software
     */
    public function setSoftware(array $software): void
    {
        $this->software = new Software($software);
    }

    /**
     * Set environment
     */
    public function setEnvironment(Environments $environment): void
    {
        $this->environment = $environment->toArray();
    }

    /**
     * Get environment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }
}
