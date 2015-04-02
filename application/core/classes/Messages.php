<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 02.04.2015
 * Time: 8:38
 */

class Messages {

    const ERROR_MSG = 'error';
    const WARNING_MSG = 'warning';
    const CONFIRM_MSG = 'confirm';

    const UNKNOWN_MSG = 'unknown';

    private $_errors = array();
    private $_warnings = array();
    private $_confirm = array();

    private $_unknown = array();

    public function __construct() {}

    public function addMessage($message, $type = self::UNKNOWN_MSG)
    {
        switch($type) {
            case self::ERROR_MSG: $this->_errors[] = $message; break;
            case self::WARNING_MSG: $this->_warnings[] = $message; break;
            case self::CONFIRM_MSG: $this->_confirm[] = $message; break;
            default: $this->_unknown[] = $message;
        }
    }

    public function getMessages()
    {
        return array(
            self::ERROR_MSG => $this->_errors,
            self::WARNING_MSG => $this->_warnings,
            self::CONFIRM_MSG => $this->_confirm,
        );
    }

    public function getErrors()
    {
        return $this->_errors;
    }

    public function getWarnings()
    {
        return $this->_warnings;
    }

    public function getConfirms()
    {
        return $this->_confirm;
    }

    public function getUnknownMessages()
    {
        return $this->_unknown;
    }

}