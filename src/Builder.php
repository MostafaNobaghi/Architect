<?php

namespace MostafaNobaghi\Architect;


use MostafaNobaghi\Architect\Abstracts\Map;
use MostafaNobaghi\Architect\Inputs\Input;

class Builder
{
    public function __construct(private Input $input, private Map $map)
    {
    }

    /**
     * build and return final data array
     */
    public function build(): array
    {
        $builtData = [];
        return $this->mapData($this->map->map, $builtData);
    }

    /**
     * build final data from input based on the map
     */
    private function mapData($map, &$output): array
    {
        foreach ($map as $key => $address) {
            if (is_array($address)) {
                $this->mapData($address, $output[$key]);
            } else {
                $output[$key] = $this->getDataItem($address);
            }
        }
        return $output;
    }

    /**
     * Extract an item from input by its address
     */
    private function getDataItem($address)
    {
        return $this->map->extractDataFromInput($this->input->getData(), $address);
    }
}
