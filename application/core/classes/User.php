<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 01.04.2015
 * Time: 11:57
 */

class User {

    private $_name;
    private $_pass;
    private $_ip;
    private $_sessionId;

    public $logged;

    public function __construct($name = false, $pass = false)
    {
        $this->_name = $name;
        $this->_pass = $pass;
        $this->_ip = $_SERVER['REMOTE_ADDR'];
        $this->_sessionId = session_id();
        $this->init();
    }

    private function init()
    {
        if ($this->_name && $this->_pass) {
            $logined = $this->isLogined();
        } else {
            $logined = $this->checkAccess($this->_name, $this->_pass);
        }
        $this->logged = $logined;
    }

    public function isLogined()
    {
        return ($this->checkSessionData('name') && $this->checkSessionData('ip') && $this->checkSessionData('session_id'));
    }

    private function checkSessionData($key)
    {
        return (isset($_SESSION[$key]) && isset($_COOKIE[$key]) && $_SESSION[$key] == $_COOKIE[$key]);
    }

    private function setSessionData($key, $value)
    {
        $_SESSION[$key] = $value;
        setcookie($key, $value);
    }

    private function checkAccess($name, $pass)
    {
        $logged = false;
        $users = array(
            'user'=>'12345',
        );

        if (isset($users[$name]) && $users[$name] == $pass) {
            $this->setSessionData('name', $this->_name);
            $this->setSessionData('ip', $this->_name);
            $this->setSessionData('session_id', $this->_name);
            $logged = true;
        }

        return $logged;
    }

    public static function logout()
    {
        session_destroy();
    }

}