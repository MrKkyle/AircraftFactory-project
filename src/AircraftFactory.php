<?php

namespace Kyle\S2sminiProject;

use Kyle\S2sminiProject\Baloon;
use Kyle\S2sminiProject\Helicopter;
use Kyle\S2sminiProject\JetPlane;
use Kyle\S2sminiProject\Coordinates;
use Kyle\S2sminiProject\Utils;  

class AircraftFactory/* converts the config into aircrafts */
{
    public static function newAircraft(string $type, string $name, int $longitude, int $latitude, int $height): Flyable
    {
        try
        {
            $coordinates = new Coordinates($longitude, $latitude, $height);
            if($type == "jetplane")
            {
                $jetplane = new Jetplane($name, $coordinates);
                return $jetplane;
            }
            else if($type = "baloon")
            {
                $baloon = new Baloon($name, $coordinates);
                return $baloon;
            }
            else if($type = "helicopter")
            {
                $helicopter = new Helicopter($name, $coordinates);
                return $helicopter;
            }
            else
            {
                /* $name instead of $this->name since its defined in the function Aircraft factory */
                throw new \Exception("Undefined aircraft type with name " . $name . " and type " . $type);  
            }
        }
        catch(\Exception $error)
        {
            print_r($error->getMessage());
            exit();
        }            
    }

    public function aircraftSimulation(): void /*returns nothing, requires nothing */
    {
        $aircrafts = include('config/config.php');  /* returns the array of config*/
                                                    /*gets the info of the config file */
        $type = strtolower($aircrafts["type"]);     /*converts to lowercase to keep the names equal */
        $name = $aircrafts["name"]; 
        $longitude = Utils::convertToInt($aircrafts["coordinates"]["longitude"]);
        $latitude = Utils::convertToInt($aircrafts["coordinates"]["latitude"]);
        $height = Utils::convertToInt($aircrafts["coordinates"]["height"]);


    }
}



?>