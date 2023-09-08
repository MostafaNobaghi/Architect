# Architect
 This package map an input data to your desired structure
 
## Install:
`composer require mostafaNobaghi/architect`

## basic Usage:
```
$data = Architect::buildObject(input: $jsonData,  map: 'path-to/your-model-map.yaml');
```
### input:
You can  create your own Input object by extending a class from `MostafaNobaghi\Architect\Inputs\Input`

### map:
You can  create your own Map object by extending a class from `MostafaNobaghi\Architect\Abstract\Map`

## use methods in maps:

in yaml file:
```angular2html
model: ((getModel))
```

in your map class:
```
<?php

namespace App\Maps;

use MostafaNobaghi\Architect\Abstracts\Map;

class DynamicMap extends Map
{

    protected function getModel($input)
    {
        return "{$input['brand']} - {$input['model']}";
    }
    
    ...
```


