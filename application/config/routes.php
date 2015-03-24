<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 24.03.2015
 * Time: 11:18
 */
    Config::set('routes', array(
        'node/([0-9]+)'=>'main/view/$1',
        'node/export'=>'main/export',
    ));