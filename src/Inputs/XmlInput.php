<?php

namespace MostafaNobaghi\Architect\Inputs;

class XmlInput extends Input
{
    /**
     * check if input string is a valid xml string
     */
    public static function isValid($input): bool
    {
        libxml_use_internal_errors(true);
        return simplexml_load_string($input) ? true : false;
    }

    public function convertInputToArray($input): self
    {
        $this->data = (array) simplexml_load_string($input);
        return $this;
    }
}
