<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 20.03.2015
 * Time: 3:30
 */

class App {

    private static $_coreClasses = array(
          'Model'=>'Model.php',
          'View'=>'View.php',
          'Controller'=>'Controller.php',
          'Route'=>'Route.php',
          'Config'=>'Config.php',
          'Db'=>'Db.php',
          'ExtException'=>'classes/ExtException.php',
          'Request'=>'classes/Request.php',
    );

    /** @var  Request */
    public static $request;

    private function __construct() {}
    private function __clone() {}

    public static function init()
    {
        self::$request = new Request();
        Route::start();
    }

    public static function autoload($class) {
        $fileName = $class.'.php';
        try {
            if (isset(self::$_coreClasses[$class])) {
                require_once CORE.self::$_coreClasses[$class];
            }
            else if (file_exists(MODELS.$fileName)) {
                include_once MODELS.$fileName;
            } else if (file_exists(CONTROLLERS.$fileName)) {
                include_once CONTROLLERS.$fileName;
            } else if (file_exists(EXTENSIONS.$fileName)) {
                include_once EXTENSIONS.$fileName;
            } else {
                throw new Exception('Can\'t load class '.$class);
            }
        }
        catch (ExtException $e) {
            throw new ExtException($e->getMessage());
        }
    }

}