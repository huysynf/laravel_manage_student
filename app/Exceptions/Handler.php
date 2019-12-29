<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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


    public function report(Exception $exception)
    {
        parent::report($exception);
    }


    public function render($request, Exception $exception)
    {
        if($exception instanceof ModelNotFoundException){
            return redirect()->route('errors.notfound');
        }
        if ($exception instanceof AuthorizationException){
            return redirect()->route('errors.forbidden');
        }
        return parent::render($request, $exception);
    }
}
