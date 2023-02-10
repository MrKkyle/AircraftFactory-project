<?php

/*utility classes that converts the config values to int if string */
namespace Kyle\S2sminiProject;  /*same as others */

class Utils
{
    public static function convertToInt(mixed $variable): ? int /* returns both null and integer */
    {
        if(is_numeric($variable))
        {
            if($variable > 100) /* if more than 100, then return 100 instead */
            {
                return 100;
            }
            if($variable < 0) /* if value is negative, returns  0 */
            {
                return 0;
            }
            return (int) $variable; /*converts into an integer */
        }

        return 0;

    }

}

?>