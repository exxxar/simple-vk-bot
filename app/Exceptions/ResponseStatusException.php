<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ResponseStatusException extends Exception
{
    //

    public $title;

    public function __construct($title = "", $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->title = $title;
    }

    public function toJSON()
    {
        return (object)[
            "title" => $this->title,
            "code" => $this->code,
            "message" => $this->message,
        ];
    }
}
