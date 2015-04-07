<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 24.03.2015
 * Time: 11:18
 */
    Config::set('routes', array(
        '/'=>'main/index',
        'about'=>'main/about',

        'node'=>'node/index',
        'node/([0-9]+)'=>'node/view/$1',
        'node/add'=>'node/add',
        'node/export'=>'main/export',
        'node/random'=>'node/random',

        'user'=>'user/login',
        'user/login'=>'user/login',
        'user/profile'=>'user/profile',

    ));