<?php

namespace App\Maps;

use MostafaNobaghi\Architect\Abstracts\Map;

class CarDynamicMap extends Map
{
    public function __construct()
    {
        $mapPath = app_path('Maps/car-dynamic.yaml');
        parent::__construct($mapPath);
    }

    protected function getModel($input)
    {
        return "{$input['brand']} - {$input['model']}";
    }
}
