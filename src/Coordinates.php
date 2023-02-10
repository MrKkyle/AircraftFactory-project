<?php

namespace Kyle\S2sminiProject;
class Coordinates 
{
    private int $longitude;
    private int $latitude;
    private int $height;

    public function __construct(int $longitude, int $latitude, int $height)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->height = $height;
    }

    public function getLongitude(): int
    {
        return $this->longitude;
    }
    public function getLatitude(): int
    {
        return $this->latitude;
    }
    public function getHeight(): int
    {
        return $this->height;
    }

    public function setLongitude(int $longitude): void
    {
        $this->longitude = $longitude;
    }
    public function setLatitude(int $latitude): void
    {
        $this->latitude = $latitude;
    }
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }
}

?>
