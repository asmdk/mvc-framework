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

    /**
     * set setting value
     *
     * @param $key
     * @param $value
     * @param bool $merge if value is array you vam merge with your array or replace
     */
    public static function set($key, $value, $merge = false)
    {
        if (isset(self::$settings[$key]) && is_array(self::$settings[$key]) &&
                is_array($value) && $merge) {
            self::$settings[$key] = array_merge(self::$settings[$key], $value);
        }
        else {
            self::$settings[$key] = $value;
        }
    }

    public static function get($key = null) {
        $value = null;
        if (!empty($key) && is_string($key) && isset(self::$settings[$key])) {
            $value = self::$settings[$key];
        }
        return $value;
    }

    /**
     * Return array of settings values
     *
     * @param $keys
     * @return array
     */
    public static function getParams($keys)
    {
        $result = array();
        if (!is_array($keys))  {
            $keys = array($keys);
        }
        foreach($keys as $key) {
            $result[] = self::get($key);
        }
        return $result;
    }

}
