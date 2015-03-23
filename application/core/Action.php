<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 23.03.2015
 * Time: 10:33
 */

abstract class Action {

    /** @var  Controller */
    public $controller;

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    /** method run class */
    abstract function run();

}