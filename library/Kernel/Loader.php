<?php
namespace Kernel;

class Loader
{
    protected static $_map = array();

    public static function configure(array $map)
    {
        self::$_map = $map;
    }

    public static function register()
    {
        spl_autoload_register('Kernel\\Loader::load');
    }

    public static function load($className)
    {
        foreach (self::$_map as $namespace=>$path) {
            if (strpos($className, $namespace)!==0) continue;
            $fileName = $path . str_replace('\\', '/', str_replace($namespace, '', $className)) . '.php';
            if (!file_exists($fileName)) throw new \RuntimeException('File "' . $fileName . '" unreadable!');
            return include_once($fileName);
        }
        throw new \RuntimeException('Class "' . $className . '" not found!');
    }
}

