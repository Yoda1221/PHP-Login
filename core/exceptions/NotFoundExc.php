<?php

namespace App\core\exceptions;

use Exception;

class NotFoundExc extends Exception {
    protected $code     = 404;
    protected $message  = "Page Not Found!";
}
