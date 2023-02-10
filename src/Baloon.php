<?php

namespace Kyle\S2sminiProject;

use Kyle\S2sminiProject\Aircraft;   
use Kyle\S2sminiProject\Flyable;

class Baloon extends Aircraft implements Flyable
{
    private WeatherTower $weatherTower;
    
    public function __construct(string $name, Coordinates $coordinates) 
    /* doesnt require the  type in the constructor */
    {
        parent::__construct($name,"baloon", $coordinates);
 
    }

    public function updateConditions(): void
    {   /* since its a private variable, we call it using $this */
        $this->weatherTower= new WeatherTower();    /* need to create the class before using its methods */
        $weather = $this->weatherTower->getWeather($this->coordinates);
        if($weather == "SUN")   /* apply aircrafts's weather changes */
        {
            /* type#name(id): message */
            print_r($this->type . "#" . $this->name . "(" . $this->getId() . "):" . "BEST TIME TO GLIDE");
            $this->setHeight($this->getHeight() + 4);
            $this->setLongitude($this->getLongitude() + 2);
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
            $this->setHeight($this->getHeight() - 15);
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
            $this->setHeight($this->getHeight() - 5);
        
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
        else if($weather == "FOG") 
        {
            print_r($this->type . "#" . $this->name . "(" . $this->getId() . "):" . "BEST TIME TO GLIDE");
            $this->setHeight($this->getHeight() - 3);
            
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

    }
    /* since  '$weatherTower' is defined here, and since weatherTower class extends tower class the functions
        inside tower can be applied here, such as register, and can be called using the weatherTower variable
    */
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