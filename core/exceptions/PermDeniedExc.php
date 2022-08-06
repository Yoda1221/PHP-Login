<?php

namespace App\core\exceptions;

use Exception;

class PermDeniedExc extends Exception {

    protected $code     = 403;
    protected $message  = "Permission Denied!";
    
}
