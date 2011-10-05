<?php
namespace Kernel;

class Registry
{
    protected static $_hash = array();

    public static function get($name)
    {
        return self::$_hash[$name];
    }

    public static function set($name, $instance)
    {
        if (!is_object($instance))
            throw new \InvalidArgumentException('Expected object ' . var_export($instance, true) . ' given');
        self::$_hash[$name] = $instance;
    }
}

