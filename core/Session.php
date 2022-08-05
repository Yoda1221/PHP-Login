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

    public function setFlashMesg($key, $message) {
        $_SESSION[self::FLAS_KEY][$key] = [
            'remove'    => false,
            'value'     => $message
        ];
    }

    public function getFlashMesg($key) {
        return $_SESSION[self::FLAS_KEY][$key]['value'] ?? false;
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
