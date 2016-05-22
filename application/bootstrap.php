<?php

    define('APPLICATION', ROOT.DS.'application'.DS);
    define('CONFIG', ROOT.DS.'application'.DS.'config'.DS);
    define('CORE', ROOT.DS.'application'.DS.'core'.DS);
    define('CACHE', ROOT.DS.'cache'.DS);
    define('VENDOR', ROOT.DS.'vendor'.DS);
    define('CORE_VIEWS', ROOT.DS.'application'.DS.'core'.DS.'views'.DS);
    define('VIEWS', ROOT.DS.'application'.DS.'views'.DS);
    define('MODELS', ROOT.DS.'application'.DS.'models'.DS);
    define('ENTITIES', ROOT.DS.'application'.DS.'entities');
    define('CONTROLLERS', ROOT.DS.'application'.DS.'controllers'.DS);
    define('EXTENSIONS', ROOT.DS.'application'.DS.'extensions'.DS);

	require_once CORE.'App.php';

    //autoLoader
    spl_autoload_register(array('App','autoload'));

    //vendor
    require_once VENDOR.'autoload.php';

    //load config
    require_once CONFIG.'settings.php';
    require_once CONFIG.'routes.php';