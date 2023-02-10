<?php

namespace Kyle\S2sminiProject;
use Kyle\S2sminiProject\Tower;
use Kyle\S2sminiProject\WeatherProvider;

class WeatherTower extends Tower
{
    public function getWeather(Coordinates $coordinates): string
    {
        $weatherProvider = WeatherProvider::getProvider();  /* static hence :: */
        $weatherType = $weatherProvider->getCurrentWeather($coordinates);
        return $weatherType;
    } 

    public function changeWeather(): void
    {
        
        WeatherProvider::seedGen(); /* changes the weather */


    }

}

?>