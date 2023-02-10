<?php

namespace Kyle\S2sminiProject;

class WeatherProvider
{
    private static WeatherProvider $weatherProvider;

    private static array $weatherSeed = 
    [
        [
            "from" => 
            [
                "0","0","0"
            ],
            "to" => 
            [
                "25","25","25"
            ]
        ],
        [
            "from" => 
            [
                "26","26","26"
            ],
            "to" => 
            [
                "50","50","50"
            ]
        ],
        [
            "from" => 
            [
                "51","51","51"
            ],
            "to" => 
            [
                "75","75","75"
            ]
        ],
        [
            "from" => 
            [
                "76","76","76"
            ],
            "to" => 
            [
                "100","100","100"
            ]
        ]
    ];

    private static array $weather = 
    [
        "RAIN" => [],
        "FOG" => [],
        "SUN" => [],
        "SNOW" => []
    ];

    private static array $weatherRadius = 
    [
        "RAIN" => 0,
        "FOG" => 0,
        "SUN" => 0,
        "SNOW" => 0
    ];

    //no non-static variables so we cant define any
    //object parameters for this class
    //contains all static methods/parameters
    public function __construct()
    {

    }

    /** it must check if there is an already existing instance of the class
     * if it is, then return that instance 
     * otherwise it returns a new instance 
     */
    public static function getProvider(): WeatherProvider
    {
        if(!isset(self::$weatherProvider))
        {
            self::$weatherProvider = new WeatherProvider();
        }
        return self::$weatherProvider;
    }

    /** Calculates 
     * (x0−xc)2+(y0−yc)2+(z0−zc)2 ≤ r2
     * and returns the weather that a particular point is experiencing
     */
    public function getCurrentWeather(Coordinates $coordinates): string
    {
        /** should return the type of weather the coordinate is experiencing
        * based on that coordinates that the aircraft has
        * returns the string 

        * lets think of weather being spread over a big area
        * that has it's own coordinates
        * if an aircraft, that has its own coordinates, is found in that area
        * that is experiencing that weather then it is under that weather's effect */

        //(5,80,20)
        $weatherType = "NONE";

        $value = (
            ($coordinates->getLongitude() - 0)**2 + 
            ($coordinates->getLatitude() - 0)**2 + 
            ($coordinates->getHeight() - 0)**2
        );

        for($i = 0; $i < sizeof(self::$weatherRadius); ++$i)
        {
            if($value <= self::$weatherRadius[array_keys(self::$weatherRadius)[$i]])
            {
                $weatherType = array_keys(self::$weather)[$i];
                return $weatherType;
            }
        }
        return $weatherType;
    }

    public static function seedGen(): array
    {
        //generates three numbers
        $numbers = range(0, 3);
        shuffle($numbers); // shuffles them into a unique order

        for($i = 0; $i < sizeof($numbers); ++$i)
        {
            /**
             * Calculates the weather's Radius using the three
             * coodinates found in the weatherSeed["to"] array 
             * it returns a number that signifies the radius of the circle
             * Assigns the value to the respective `array_key` value inside the weather array
             * [
             *  `array_key` => array_value
             * ]
             * and using `$i` to select the appropriate random element
             */
            self::$weatherRadius[array_keys(self::$weather)[$i]] = self::calWeatherRadius(self::$weatherSeed[$numbers[$i]]["to"]);
            
            /**
             * Assigns the weatherSeed array to the respective weather array value using 
             * the `array_key` value inside the weather array and using `$i` to select a unique
             * element from the array
             */
            self::$weather[array_keys(self::$weather)[$i]] = self::$weatherSeed[$numbers[$i]];
        }

        //sorts the arrays in the same order (ascending) to make the checks
        //on the getCurrentWeather function more valid
        //it has to check from the lowest to the highest to
        //take into consideration all the values that was generated
        array_multisort(self::$weatherRadius, self::$weather);

        return self::$weather;
    }

    /**
     * Calculates the radius of certain coordinates
     */
    private static function calWeatherRadius(array $coordinates): int
    {
        $value = (
            ($coordinates[0] - 0)**2 + 
            ($coordinates[1] - 0)**2 + 
            ($coordinates[2] - 0)**2
        );
        return $value;
    }
}

?>