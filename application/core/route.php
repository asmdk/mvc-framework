<?php 

class Route
{
    public static function start()
    {
        // контроллер и действие по умолчанию
        $controllerPrefix = 'Main';
        $actionPrefix = 'Index';
        
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if ( !empty($routes[1]) )
        {	
            $controllerPrefix = $routes[1];
        }
        
        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            $actionPrefix = $routes[2];
        }

        // добавляем префиксы
        $model_name = $controllerPrefix.'Model';
        $controller_name = $controllerPrefix.'Controller';
        $action_name = 'action'.ucfirst($actionPrefix);
        
        // создаем контроллер
        $controller = new $controller_name($controllerPrefix, $action_name);
		$action = $action_name;
        
        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            $controller->$action();
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }
    
    }
    
    public static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}