<?php

namespace MostafaNobaghi\Architect\Inputs;

/**
 * Get raw data and make an Input object
 */
final class InputFactory
{
    public function __construct(private $input)
    {
    }

    public static function getInput($input)
    {
        return (new self($input))->makeInput();
    }

    public function makeInput(): Input
    {
        if (is_a($this->input, Input::class)) {
            return $this->input;
        }
        return $this->buildInput();
    }

    /**
     * Build an Input object from a data based on its type (json, xml, etc )
     */
    private function buildInput(): Input
    {
        if (!is_string($this->input)) {
            throw new \InvalidArgumentException('Input must be a string or a ' . Input::class);
        }

        if (JsonInput::isValid($this->input)) {
            return (new JsonInput($this->input));
        }

        if (XmlInput::isValid($this->input)) {
            return (new XmlInput($this->input));
        }

        throw new \InvalidArgumentException('string inputs must be valid "json" or "xml" formats');
    }
}
