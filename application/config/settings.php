<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 19.03.2015
 * Time: 9:23
 */

    Config::set('db', array(
        'driver'=>'mysql',
        'host'=>'localhost',
        'name'=>'mvc',
        'user'=>'root',
        'pass'=>'root',
        'port'=>3306,
    ));

    Config::set('controller_404', 'main');
    Config::set('action_404', 'errorPage');
    //Config::set('View', 'ViewTwig');