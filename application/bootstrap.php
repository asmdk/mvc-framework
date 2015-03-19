<?php

    define('APPLICATION', ROOT.DS.'application'.DS);
    define('VIEWS', ROOT.DS.'application'.DS.'views'.DS);
    define('MODELS', ROOT.DS.'application'.DS.'models'.DS);
    define('CONTROLLERS', ROOT.DS.'application'.DS.'controllers'.DS);
    define('EXTENSIONS', ROOT.DS.'application'.DS.'extensions'.DS);

	require_once 'core/model.php';
	require_once 'core/view.php';
	require_once 'core/controller.php';
	require_once 'core/route.php';
	require_once 'core/config.php';
	require_once 'settings.php';
	require_once 'core/db.php';

    //TODO: maybe need include autoload all files
    //load all models
    spl_autoload_register(function ($class) {
        $fileName = $class.'.php';
        if (file_exists(MODELS.$fileName)) {
            require_once MODELS.$fileName;
        } else if (file_exists(CONTROLLERS.$fileName)) {
            require_once CONTROLLERS.$fileName;
        } else if (file_exists(EXTENSIONS.$fileName)) {
            require_once EXTENSIONS.$fileName;
        } else {
            throw new Exception('Can\'t load class '.$class);
        }
    });

	Route::start(); // запускаем маршрутизатор