<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 19.03.2015
 * Time: 9:05
 */

class Db
{
    /** @var null|PDO $db */
    private static $db = null;
    /**
     * @return null|PDO Db
     */
    public static function getInstance()
    {
        if (null === self::$db)
        {
            self::init();
        }
        return self::$db;
    }
    private function __clone() {}
    private function __construct() {}

    private static function init() {
        $settings = Config::get('db');
        if (!empty($settings)) {
            try {
                $dsn = 'mysql:host='.$settings['host'].';dbname='.$settings['name'].';port='.$settings['port'].';charset='.$settings['charset'];
                self::$db = new PDO($dsn, $settings['user'], $settings['pass']);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$db->exec('SET NAMES utf8');
            } catch (PDOException $e) {
                die('Connection error: ' . $e->getMessage());
            }
        }
    }
}