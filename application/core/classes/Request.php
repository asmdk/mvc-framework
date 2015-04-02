<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 20.03.2015
 * Time: 7:14
 */

class Request {

    private $_requestUri;
    private $_requestTime;
    private $_queryString;
    private $_serverUri;
    private $_requestMethod;
    private $_serverProtocol;
    private $_serverName;
    private $_serverPort;

    private $_isAjax;
    private $_isPost;

    public function __construct() {
        $bGet = strpos($_SERVER['REQUEST_URI'], '?');
        $this->_requestUri = $bGet !== false ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?')) : $_SERVER['REQUEST_URI'];
        $this->_serverUri = $_SERVER['REQUEST_URI'];
        $this->_requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->_serverProtocol = $_SERVER['SERVER_PROTOCOL'];
        $this->_serverName = $_SERVER['SERVER_NAME'];
        $this->_serverPort = $_SERVER['SERVER_PORT'];
        $this->_requestTime = $_SERVER['REQUEST_TIME'];
        $this->_queryString = $_SERVER['QUERY_STRING'];

        $this->_isPost = $_SERVER['REQUEST_METHOD'] == 'POST';
        $this->_isAjax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
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

    /**
     * @return string
     */
    public function getRequestUri()
    {
        return $this->_requestUri;
    }

    /**
     * @return mixed
     */
    public function getRequestTime()
    {
        return $this->_requestTime;
    }

    /**
     * @return mixed
     */
    public function getQueryString()
    {
        return $this->_queryString;
    }

    /**
     * @return mixed
     */
    public function getServerUri()
    {
        return $this->_serverUri;
    }

    /**
     * @return mixed
     */
    public function getRequestMethod()
    {
        return $this->_requestMethod;
    }

    /**
     * @return mixed
     */
    public function getServerProtocol()
    {
        return $this->_serverProtocol;
    }

    /**
     * @return mixed
     */
    public function getServerName()
    {
        return $this->_serverName;
    }

    /**
     * @return mixed
     */
    public function getServerPort()
    {
        return $this->_serverPort;
    }

    /**
     * @return boolean
     */
    public function isAjax()
    {
        return $this->_isAjax;
    }

    /**
     * @return boolean
     */
    public function isPost()
    {
        return $this->_isPost;
    }



}