<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 20.03.2015
 * Time: 7:14
 */

class Request {

    public function __construct() {}

    public function getGet($key, $default = null)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    public function getPost($key, $default = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    public function getRequest($key, $default = null)
    {
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
    }

    public function getParam($key, $default = null)
    {
        return isset($_GET[$key]) ? $_GET[$key] : (isset($_POST[$key]) ? $_POST[$key] : $default);
    }

}