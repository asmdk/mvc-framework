<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 19.03.2015
 * Time: 9:23
 */

class Config {
    private static $settings = array();

    private function __construct() {}
    private function __clone() {}

    public static function set($key, $value)
    {
        self::$settings[$key] = $value;
    }

    public static function get($key = null) {
        $value = null;
        if (!empty($key) && is_string($key) && isset(self::$settings[$key])) {
            $value = self::$settings[$key];
        }
        return $value;
    }
}