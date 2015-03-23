<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 20.03.2015
 * Time: 7:14
 */

class Request {

    public $requestUri;
    public $serverUri;

    public function __construct() {
        $bGet = strpos($_SERVER['REQUEST_URI'], '?');
        $this->requestUri = $bGet !== false ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?')) : $_SERVER['REQUEST_URI'];
        $this->serverUri = $_SERVER['REQUEST_URI'];
    }

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