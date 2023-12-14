<?php

namespace Alura\Banco\Service;

trait PropertiesAccess
{
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        return $this->$method();
    }
}
