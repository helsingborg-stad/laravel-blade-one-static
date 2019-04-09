<?php

namespace LaravelBladeOneStatic\BladeOneStatic;

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
     * Init BladeOne
     * @return bool|Blade
     */
    public static function init()
    {
        if (!class_exists('\BladeComponentLibrary\Register')) {
            return false;
        }

        self::$bladeOne = new Blade(
            (array)\BladeComponentLibrary\Register::$viewPaths,
            (string)\BladeComponentLibrary\Register::$cachePath
        );

        return self::$bladeOne;
    }

    /**
     * @param $params
     * @return bool
     * @throws \Exception
     */
    public static function loadPageTemplate($params)
    {
        if (!class_exists('eftec\bladeone\BladeOne')) {
            return false;
        } else {
            throw new \Exception("Error running Blade one");
        }

        $views = __DIR__ . "/../../views/";
        $cache = __DIR__ . "/../../cache/";

        $blade = new Blade($views, $cache, BladeOne::MODE_AUTO);
        echo $blade->run($params['template'], $params['data']);
    }


    /**
     * Run Blade Engine
     * @param $params
     * @return bool
     * @throws \Exception
     */
    public static function initBladeOne($params)
    {
        if (!class_exists('eftec\bladeone\BladeOne')) {
            return false;
        }

        if (class_exists('\BladeComponentLibrary\Register')) {
            return self::$bladeOne->run(
                (string)$params['utilityViewName'],
                (array)$params['utilityArgsControlerData']
            );

        } else {
            throw new \Exception("Error running Blade one");
        }
    }
}