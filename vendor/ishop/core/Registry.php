<?php
/**
 * Created by PhpStorm.
 * User: hairutdinovbr
 * Date: 2019-02-15
 * Time: 2:31 PM
 */

namespace ishop;

use ishop\traits\TSingleton;

class Registry
{
    use TSingleton;

    protected static $properties = [];

    public function getProperty($name)
    {
        if ( isset(self::$properties[$name]) ) {
            return self::$properties[$name];
        }
        return null;
    }

    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value;
    }

    public function getProperties()
    {
        return self::$properties;
    }
}