<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

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
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json(['error' => 'Resource not found'], 404);
          }

        if ($exception instanceof AuthenticationException) {
            return response()->json(['error' => 'unauthenticated'], 401);
        }

        if ($exception instanceof ModelNotFoundException) {

            return response()->json([
                'error' => 'Record not found',
            ], 404);

        }

        if ($exception instanceof UnauthorizedHttpException) {
            // detect previous instance
            if ($exception->getPrevious() instanceof TokenExpiredException) {
                return response()->json(['status' => 'token_expired'], $exception->getStatusCode());
            }
            else if ($exception->getPrevious() instanceof TokenInvalidException) {
                return response()->json(['status' => 'token_invalid'], $exception->getStatusCode());
            }
            else if ($exception->getPrevious() instanceof TokenBlacklistedException) {
                return response()->json(['status' => 'token_blacklisted'], $exception->getStatusCode());
            }
        }
          
        return parent::render($request, $exception);
    }

}
