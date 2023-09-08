<?php

namespace App\Actions;


/**
 * return sample data
 */
class TestApiAction
{

    public function __invoke($type = 'json')
    {
        if ($type === 'json') {
            $data = json_encode($this->fakeCarA());
        } elseif ($type == 'dynamic') {
            $data = json_encode($this->fakeCarD());
        } else {
            $data = $this->fakeCarB();
        }

        return $data;
    }

    private function fakeCarA()
    {
        return [
            'car_name' => 'toyota supra',
            'engine' => '2500 cc',
            'power' => [
                'horse' => 100,
                'torque' => 150
            ],
            'transmission' => [
                'speeds' => 5,
                'type' => 'manual'
            ]
        ];
    }

    private function fakeCarD()
    {
        $car = $this->fakeCarA();
        unset($car['car_name']);
        $car['brand'] = 'ford';
        $car['model'] = 'mustang 1979';
        return $car;
    }

    private function fakeCarB()
    {
        $x = '<?xml version="1.0"?>
<root>
	<name>toyota supra</name>
	<engine>2500 cc</engine>
	<horse>100</horse>
	<torque>150</torque>
	<speeds>5</speeds>
</root>';
        return $x;
    }

    public function myModel()
    {
        return [
            'model' => null,
            'engine' => [
                'model' => null,
                'horse_power' => null,
                'torque' => null
            ],
            'transmission_speeds' => null
        ];
    }
}
