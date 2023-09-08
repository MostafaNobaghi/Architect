<?php

namespace MostafaNobaghi\Architect\Inputs;

use MostafaNobaghi\Architect\Contracts\InputParser;

abstract class Input implements InputParser
{
    protected array $data;

    public function __construct(string $input)
    {
        $this->convertInputToArray($input);
    }

    public function getData(): array
    {
        return $this->data;
    }
}
