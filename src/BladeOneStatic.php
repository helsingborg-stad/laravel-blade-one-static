<?php

namespace LaravelBladeOneStatic\BladeOneStatic;

Use eftec\bladeone\BladeOne as Blade;




/**
 * Class BladeOneStatic
 * @package LaravelBladeOneStatic
 */
class BladeOneStatic implements BladeOneStaticInterface
{
    /**
     * @var
     */
    public static $bladeOne;
    public static $cachePath = "";
    public static $viewPaths = [];

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
            (array)self::$viewPaths,
            (string)self::$cachePath
        );

        return self::$bladeOne;
    }


    /**
     * @param $params
     * @return bool|string
     * @throws \Exception
     */
    public static function runBladeOne($params): array
    {
        if (!class_exists('eftec\bladeone\BladeOne')) {
            return false;
        }

        switch ($params['path']) {

            case "component":
                var_dump('HEJ Component');
                if (!self::$bladeOne) {
                    self::$bladeOne = self::init();
                }

                return self::$bladeOne->run(
                    (string)$params['utilityViewName'],
                    (array)$params['utilityArgsControlerData']
                );
                break;

            case "page":
                var_dump('HEJ Layout');
                self::$bladeOne = new Blade(
                    self::addViewPath(__DIR__ . '/../../../../views/'),
                    self::setCachePath(__DIR__ . '/../../../../cache/')
                //self::$bladeOne = self::init()
                );

                return self::$bladeOne->run($params['template'], $params['data']);
                break;
        }
    }

    /**
     * Updates the cache path
     * @param $path
     * @return string The new cache path
     */
    public static function setCachePath($path): string
    {
        return self::$cachePath = $path;
    }

    /**
     * Appends the view path object
     * @param $path
     * @param bool $prepend
     * @return array The updated object with view paths
     * @throws \Exception
     */
    public static function addViewPath($path, $prepend = true): array
    {
        //Sanitize path
        $path = rtrim($path, "/");

        //Push to location array
        if ($prepend === true) {
            if (array_unshift(self::$viewPaths, $path)) {
                return self::$viewPaths;
            }
        } else {
            if (array_push(self::$viewPaths, $path)) {
                return self::$viewPaths;
            }
        }

        //Error if something went wrong
        throw new \Exception("Error appending view path: " . $path);
    }

}