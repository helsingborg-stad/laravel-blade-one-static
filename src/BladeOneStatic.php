<?php

namespace LaravelBladeOneStatic;

Use eftec\bladeone\BladeOne as Blade;

/**
 * Class BladeOneStatic
 * @package LaravelBladeOneStatic
 */
class BladeOneStatic
{
    /**
     * @var
     */
    static $bladeOne;

    /**
     * @return Blade
     */
    public static function init()
    {
        if (!class_exist(\BladeComponentLibrary\Register)) {
            return false;
        }
        
        self::$bladeOne = new Blade(
            (array)\BladeComponentLibrary\Register::$viewPaths,
            (string)\BladeComponentLibrary\Register::$cachePath
        );

        return self::$bladeOne;
    }


    /** Init Blade Engine
     * @return string
     * @throws \Exception
     */
    public static function initBladeOne($params)
    {
        if (!class_exists(Blade::class)) {
            return false;
        }

        if (class_exist(\BladeComponentLibrary\Register)) {

            return self::$bladeOne->run(
                (string)$params['utilityViewName'],
                (array)$params['utilityArgsControlerData']
            );

        } else {
            throw new \Exception("Error running Blade one");
        }
    }


}


