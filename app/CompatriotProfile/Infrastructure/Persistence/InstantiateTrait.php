<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/13/19
 * Time: 5:22 PM
 */

namespace Elyurt\CompatriotProfile\Infrastructure\Persistence;


trait InstantiateTrait
{
    private static $_instance;
    private static $_prototype;
    public static function instance($refresh = false): self
    {
        if ($refresh || self::$_prototype === null) {
            self::$_instance = self::instantiate([]);
        }
        return self::$_instance;
    }
    public static function instantiate($row): self
    {
        if (self::$_prototype === null) {
            $class = \get_called_class();
            self::$_prototype = unserialize(sprintf('O:%d:"%s":0:{}', \strlen($class), $class));
        }
        $entity = clone self::$_prototype;
        $entity->init();
        return $entity;
    }
}