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
          'ViewTwig'=>'ViewTwig.php',
          'Controller'=>'Controller.php',
          'Action'=>'Action.php',
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
        $route = new Route(Config::get('routes'));
        $route->run();
        self::terminate();
    }

    public static function terminate()
    {
        exit();
    }
    public static function pageNotFound()
    {
        header("HTTP/1.0 404 Not Found");
        $errorController = Config::get('controller_404');
        $errorAction = Config::get('action_404');
        if (!is_null($errorController) && class_exists($errorController.'Controller')) {
            $errorController .= 'Controller';
            $errorAction .= 'Action';
            /** @var Controller $controller */
            $controller = new $errorController($errorController, $errorAction);
            if (method_exists($controller, $errorAction)) {
                call_user_func_array(array($controller, $errorAction), array());
                self::terminate();
            }
        }
        $controller = new Controller('');
        $controller->view->render('error404');
    }
    public static function createView($controller = null)
    {
        return !empty($viewClass) ? new $viewClass($controller) : new View($controller);
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
                //throw new Exception('Can\'t load class '.$class);
            }
        }
        catch (ExtException $e) {
            throw new ExtException($e->getMessage());
        }
    }

}