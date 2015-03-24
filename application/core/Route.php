<?php 

class Route
{
    public static function start()
    {
        // default controller and action
        $controllerClassName = is_null(Config::get('DefaultController')) ? '' : Config::get('DefaultController');
        $actionDefault = is_null(Config::get('DefaultAction')) ? 'Index' : Config::get('DefaultAction');

        //remove get params from route uri
        $bGet = strpos($_SERVER['REQUEST_URI'], '?');
        $serverUri = $bGet !== false ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?')) : $_SERVER['REQUEST_URI'];
        $routes = explode('/', $serverUri);
        array_shift($routes);

        //remove index php from routes
        if (!empty($routes)&& ($routes[0] == 'index.php' || empty($routes[0]))) {
            array_shift($routes);
        }

        // get controller name
        if ( !empty($routes) ) {
            $controllerClassName = array_shift($routes);
        }
        
        // get action name
        if ( !empty($routes) ) {
            $actionDefault = array_shift($routes);
        }

        //set params
        if ( !empty($routes) ) {
            $rCount = count($routes);
            for($index = 0; $index < $rCount; $index += 2) {
                $_GET[$routes[$index]] = isset($routes[$index+1]) ? $routes[$index+1] : null;
            }
        }

        // add prefix
        $controllerClass = $controllerClassName.'Controller';
        $actionName = 'action'.ucfirst($actionDefault);
        
        // create controller
        try {
            /** @var Controller $controller */
            $controller = new $controllerClass($controllerClassName, $actionName);
            $action = $actionName;
            // call action
            if ($controller->checkActionClass($actionDefault) === false) {
                $controller->$action();
            }
        }
        catch (ExtException $e) {
            throw new ExtException($e->getMessage());
        }
    
    }
}
