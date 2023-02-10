<?php

namespace Kyle\S2sminiProject;  /* allows for grouping of classes */

use Kyle\S2sminiproject\Coordinates;    /* gets that class */
class Aircraft extends Coordinates
{
    protected int $id;
    protected string $name;
    protected Coordinates $coordinates;
    private static int $idCounter;
    public string $type;


    protected function __construct(string $name, string $type, Coordinates $coordinates)
    {
        parent::__construct($coordinates->getLongitude(), $coordinates->getLatitude(), $coordinates->getHeight());

        $this->name = $name;
        $this->coordinates = $coordinates;
        $this->id = $this->nextId();     /* since its a function inside the class hence we use this on functions too */
        $this->type = strtoupper($type);
    }

    private function nextId(): int
    {    
        if(!isset(self::$idCounter)) /* if null then return 0 otherwise increment idCounter */
        {   
            /* if used inside the same class self:: is used, otherwise if different class then aircracft-> */
            self::$idCounter = 0;
            return self::$idCounter;
        }
        self::$idCounter = self::$idCounter + 1;
        return self::$idCounter;
    }

    public function getId(): int 
    {
        return $this->id;
    }

}


?>
