<?php

namespace MostafaNobaghi\Architect\Abstracts;

use Symfony\Component\Yaml\Yaml;

abstract class Map
{
    /** an array of each data address in the input data */
    readonly mixed $map;

    public function __construct(string $mapPath)
    {
        $this->setMap($mapPath);
    }

    private function setMap(string $mapPath): void
    {
        $this->map = Yaml::parse(file_get_contents($mapPath));
        if (!is_array($this->map)) {
            throw new \InvalidArgumentException('provided map is not valid');
        }
    }

    /**
     * Get the input data and an address of an item inside the input data and return the value.
     */
    public function extractDataFromInput($input, $address): string
    {
        if ($addressFunction = $this->getAddressFunction($address)) {
            return $this->getDataFromFunction($addressFunction, $input);
        }

        $addressParts = explode('.', $address);
        $value = $input;
        foreach ($addressParts as $addressPart) {
            if (!is_array($value)) {
                throw new \Exception("this Address is wrong or not compatible with input: '{$address}'");
            }
            $value = $value[$addressPart];
        }
        return $value;
    }

    private function getAddressFunction($address)
    {
        // match a string which starts with two open parentheses and ends with two closing parentheses
        $pattern = '/^\(\((.+)\)\)$/';

        if (preg_match($pattern, $address, $matches)) {
            return $matches[1];
        }
        return false;
    }

    private function getDataFromFunction($address, $input)
    {
        return $this->$address($input);
    }
}
