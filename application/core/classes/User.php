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
    private $_logged;

    public $cookie;
    public $data = null;

    public function __construct($name = null, $pass = null)
    {
        $this->_name = $name;
        $this->_pass = $pass;
        $this->_ip = $_SERVER['REMOTE_ADDR'];
        $this->_sessionId = session_id();
        $this->init();
    }

    private function init()
    {
        if (is_null($this->_name) && is_null($this->_pass)) {
            $this->_logged  = $this->isLogined();
        } else {
            $this->_logged  = $this->checkAccess($this->_name, $this->_pass);
        }
        $this->cookie = $_COOKIE;
    }

    public function getLogged()
    {
        return $this->_logged;
    }

    public function isLogined()
    {
        return ($this->checkSessionData('name') && $this->checkSessionData('ip') && $this->checkSessionData('session_id'));
    }

    private function checkSessionData($key)
    {
        $logged = (isset($_SESSION[$key]) && isset($_COOKIE[$key]) && $_SESSION[$key] == $_COOKIE[$key]);
        if ($logged) {
            $userData = $this->getUserData($_SESSION['name']);
            $this->data = $userData !== false ? $userData['data'] : null;
        }
        return $logged;
    }

    private function setSessionData($key, $value)
    {
        $_SESSION[$key] = $value;
        setcookie($key, $value);
    }

    private function getUserData($name) {
        $users = array(
            'user'=>array(
                'password'=>'12345',
                'data'=>array(
                    'name'=>'user',
                    'surname'=>'users',
                    'group'=>'admin',
                    'age'=>22,
                    'reg_date'=>date('d.m.Y', strtotime('17.06.1897')),
                ),
            ),
        );
        return (isset($users[$name])) ? $users[$name] : false;
    }

    private function checkAccess($name, $pass)
    {
        $logged = false;
        $userData = $this->getUserData($name);

        if ($userData !== false && $userData['password'] == $pass) {
            $this->setSessionData('name', $this->_name);
            $this->setSessionData('ip', $this->_ip);
            $this->setSessionData('session_id', $this->_sessionId);
            $this->data = $userData;
            $logged = true;
        }

        return $logged;
    }

    public static function logout()
    {
        session_destroy();
    }

}