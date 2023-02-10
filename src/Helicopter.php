<?php

namespace Kyle\S2sminiProject;

use Kyle\S2sminiProject\Aircraft;   
use Kyle\S2sminiProject\Flyable;

class Helicopter extends Aircraft implements Flyable
{
    private WeatherTower $weatherTower; /* allows us to use tower class to register aircrafts */

    public function __construct(string $name, Coordinates $coordinates)
    {
        parent::__construct($name,"helicopter", $coordinates);
 
    }
    
    public function updateConditions(): void    /* updates coordiantes depending on the different type of aircraft */
    {
        $this->weatherTower= new WeatherTower();

        $weather = $this->weatherTower->getWeather($this->coordinates);
        if($weather == "SUN")   /* apply aircrafts's weather changes */
        {
            print_r($this->type . "#" . $this->name . "(" . $this->getId() . "):" . "BEST TIME TO GLIDE");
            $this->setHeight($this->getHeight() + 2);
            $this->setLongitude($this->getLongitude() + 10);
            if($this->getHeight() >= 100)  
            {
                $this->setHeight(100);
            }
            if($this->getHeight() <= 0)
            {
                $this->weatherTower->unregister($this);
                print_r($this->type . "(" . $this->getId() . ")" . " landing");
            }
            
        }      
        else if($weather == "SNOW")
        {
            print_r($this->type . "#" . $this->name . "(" . $this->getId() . "):" . "BEST TIME TO GLIDE");
            $this->setHeight($this->getHeight() - 12);
            if($this->getHeight() >= 100)  
            {
                $this->setHeight(100);
            }
            if($this->getHeight() <= 0)
            {
                $this->weatherTower->unregister($this);
                print_r($this->type . "(" . $this->getId() . ")" . " landing");
            }
            
        }
        else if($weather == "RAIN") 
        {
            print_r($this->type . "#" . $this->name . "(" . $this->getId() . "):" . "BEST TIME TO GLIDE");
            $this->setLongitude($this->getLongitude() + 5);
            
        }
        else if($weather == "FOG") 
        {
            print_r($this->type . "#" . $this->name . "(" . $this->getId() . "):" . "BEST TIME TO GLIDE");
            $this->setLongitude($this->getLongitude() + 1);
            
        }
    }

    public function registerTower(WeatherTower $weatherTower): void
    {
        if(!isset($this->$weatherTower))
        {
            $weatherTower = new WeatherTower();
            $this->weatherTower = $weatherTower;
        }
        
        $this->weatherTower->register($this);   /* apply changes to 'this' object */
        print_r("TOWER SAYS: " . $this->type . "(" . $this->getId() . ")" . " REGISTERED TO WEATHER TOWER");
    }

}


?>