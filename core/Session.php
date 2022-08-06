<?php

namespace App\core;

class Session {
    protected const FLAS_KEY = 'flash_messages';

    public function __construct() {
        session_start();
        $flashMessages = $_SESSION[self::FLAS_KEY] ?? [];

        foreach ($flashMessages as $key => &$fMessage) {
            $fMessage['remove'] = true;
        }
        $_SESSION[self::FLAS_KEY] = $flashMessages;
    }

    /**
     ** SETUP FLASH MESSAGE
     *
     * @param [ string ] $key
     * @param [ string ] $message
     * @return void
     */
    public function setFlashMesg($key, $message) {
        $_SESSION[self::FLAS_KEY][$key] = [
            'remove'    => false,
            'value'     => $message
        ];
    }

    /**
     ** GET THE FLASH MESSAGE
     *
     * @param [ string ] $key
     * @return void
     */
    public function getFlashMesg($key) {
        return $_SESSION[self::FLAS_KEY][$key]['value'] ?? false;
    }

    /**
     ** GET THE FLASH MESSAGE BASED ON THE KEY
     *
     * @param [ string ] $key
     * @return void
     */
    public function get($key) {
        return $_SESSION[$key] ?? false;
    }
    
    /**
     ** SET THE FLASH MESSAGE
     *
     * @param [ string ] $key
     * @param [ string ] $value
     * @return void
     */
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    /**
     ** REMOVE THE FLASH MESSAGE BASED ON THE KEY
     *
     * @param [ string ] $key
     * @return void
     */
    public function remove($key) {
        unset($_SESSION[$key]);
    }

    public function __destruct() {
        $flashMessages = $_SESSION[self::FLAS_KEY] ?? [];

        foreach ($flashMessages as $key => &$fMessage) {
            if ($fMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLAS_KEY] = $flashMessages;
    }

}
