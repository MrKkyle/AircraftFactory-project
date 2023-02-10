<?php

namespace Kyle\S2sminiProject;
class Tower
{

    private Flyable $observers;
    
    public function register(Flyable $flyable): void
    {
        /*assigns the flyable object to the observers, will be different each instance*/
        $this->observers = $flyable; 
    }

    public function unregister(Flyable $flyable): void
    {
        /* if height <= 0 then unregister */
        unset($this->observers);
    }
    protected function conditionsChanged(): void
    {
        
    }

}

?>