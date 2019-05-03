<?php 

class Car {
    protected $fuel;
    protected $max_fuel;
    protected $license_plate;

    function __constructor($license_plate, $fuel, $max_fuel) {
        $this->fuel = $fuel;
        $this->max_fuel = $max_fuel;
        $this->license_plate = $license_plate;
    }
}



function getFuel() {
    return $this->fuel;
}

function refuel($fuelAmount = 0) {
    if($fuelAmount !=0) {
        $this->fuel = min($this->fuel + $fuelAmount, 
    $this->max_fuel);
    }
    else {
        $this->fuel = $this->max_fuel;
    }
} 


function get($key) {
    return $this->$key;
}

function set($key, $value){
    $this->$key = $value;
 }

 static function () {
     return array('Mercedes', 'Honda');
 }
?>
