<?php

    define('APPLICATION', ROOT.DS.'application'.DS);
    define('CORE', ROOT.DS.'application'.DS.'core'.DS);
    define('VIEWS', ROOT.DS.'application'.DS.'views'.DS);
    define('MODELS', ROOT.DS.'application'.DS.'models'.DS);
    define('CONTROLLERS', ROOT.DS.'application'.DS.'controllers'.DS);
    define('EXTENSIONS', ROOT.DS.'application'.DS.'extensions'.DS);

	require_once CORE.'App.php';

    //autoLoader
    spl_autoload_register(array('App','autoload'));

    //load config
    require_once 'settings.php';

    //start app
    App::init();