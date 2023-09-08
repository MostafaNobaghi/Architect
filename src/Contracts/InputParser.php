<?php

namespace MostafaNobaghi\Architect\Contracts;

interface InputParser
{
    /**
     * this method must get some data as input and convert it to an array
     */
    public function convertInputToArray($input): self;

}
