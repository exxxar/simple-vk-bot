<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Throwable $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ResponseStatusException) {
            $object = $exception->toJson();

            return response()->json([
                "title" => $object->title,
                "code" => $object->code,
                "message" => $object->message
            ], $object->code);
        }

        if ($exception instanceof ValidationException) {
            $tmp = "";

            foreach ($exception->errors() as $error) {
                foreach ($error as $e)
                    $tmp .= $e . " ";
            }

            return response()->json([
                "title" => "Validation Error",
                "code" => $exception->status,
                "message" => $tmp
            ], $exception->status);


        }

        return parent::render($request, $exception);
    }
}
