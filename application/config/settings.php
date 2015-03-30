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

    Config::set('doctrine', array(
        'driver'=>'pdo_mysql',
        'host'=>'localhost',
        'dbname'=>'mvc',
        'user'=>'root',
        'password'=>'root',
    ));
    Config::set('doctrine_dev_mode', false);

    Config::set('controller_404', 'main');
    Config::set('action_404', 'errorPage');
    Config::set('View', 'ViewTwig');