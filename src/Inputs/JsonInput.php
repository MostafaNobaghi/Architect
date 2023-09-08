<?php

namespace MostafaNobaghi\Architect\Inputs;

class JsonInput extends Input
{
    /**
     * check if input string is a valid json string
     */
    public static function isValid($input): bool
    {
        $data = json_decode($input, true);
        return json_last_error() === JSON_ERROR_NONE && is_array($data);
    }

    public function convertInputToArray($input): self
    {
        $this->data = json_decode($input, true);
        return $this;
    }
}
