<?php 

class Route
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    private function getURI()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach($this->routes as $pattern => $route){
            if(preg_match("~$pattern~", $uri)){
                $internalRoute = preg_replace("~$pattern~", $route, $uri);
                $segments = explode('/', $internalRoute);
                array_shift($segments);
                $controllerClass = ucfirst(array_shift($segments)).'Controller';
                $actionSegment = array_shift($segments);
                $actionName = 'action'.ucfirst($actionSegment);
                $parameters = $segments;

                // create controller
                try {
                    /** @var Controller $controller */
                    $controller = new $controllerClass(str_replace('Controller', '', $controllerClass), str_replace('action', '', $actionName));
                    $action = ($actionName == 'action') ? $actionName.$controller->defaultAction : $actionName;
                    // call action
                    if ($controller->checkActionClass($actionSegment, $parameters) === false) {
                        // Вызываем действие контроллера с параметрами
                        call_user_func_array(array($controller, $action), $parameters);
                    }
                }
                catch (ExtException $e) {
                    throw new ExtException($e->getMessage());
                }
            }
        }

        // Ничего не применилось. 404.
        header("HTTP/1.0 404 Not Found");
        return;
    }

    /** old route method is deprecated */
    private function start()
    {
        // default controller and action
        $controllerClassName = is_null(Config::get('DefaultController')) ? '' : Config::get('DefaultController');
        $actionDefault = is_null(Config::get('DefaultAction')) ? '' : Config::get('DefaultAction');

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
            $controller = new $controllerClass(str_replace('Controller', '', $controllerClass), str_replace('action', '', $actionName));
            $action = ($actionName == 'action') ? $actionName.$controller->defaultAction : $actionName;
            // call action
            if ($controller->checkActionClass($actionName, null) === false) {
                // Вызываем действие контроллера с параметрами
                $controller->{$action}($controller);
            }
        }
        catch (ExtException $e) {
            throw new ExtException($e->getMessage());
        }
    
    }
}
