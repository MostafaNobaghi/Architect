<?php

namespace MostafaNobaghi\Architect;

use MostafaNobaghi\Architect\Abstracts\Map;
use MostafaNobaghi\Architect\Inputs\Input;
use MostafaNobaghi\Architect\Inputs\InputFactory;

/**
 * Architect class receives an input and a map, and build a new data array from input based on the map.
 *
 * $map can be a string and a path of a yaml file, or it can be an Abstracts\Map object.
 * so user can extend its own customized map.
 *
 * $input can be an encoded xml or json string, or an Input\Input object. so user can extend its own customized input
 */
class Architect
{

    private Map $map;
    private Input $input;

    public function __construct(Input|string $input, Map|string $map)
    {
        $this->setMap($map);
        $this->setInput($input);
    }

    /**
     * Build the final data from input
     */
    public function build(): array
    {
        return (new Builder($this->input, $this->map))->build();
    }

    /**
     * A static wrapper for build method
     */
    public static function buildObject(Input|string $input, Map|string $map): array
    {
        return (new static($input, $map))->build();
    }

    private function setMap($map): void
    {
        if (is_string($map)) {
            $map = new class($map) extends Map{};
        }
        $this->map = $map;
    }

    private function setInput(Input|string $input): void
    {
        if (is_string($input)) {
            $input = InputFactory::getInput($input);
        }
        $this->input = $input;
    }
}
