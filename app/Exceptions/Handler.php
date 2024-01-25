<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $exception): void {});
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof BusinessLogicException) {
            return response()->json([
                'status' => $exception->getCode(),
                'errors' => [
                    'message' => $exception->getMessage(),
                ],
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'status' => config('response.codes.invalid_input'),
                'errors' => [
                    'message' => $exception->errors(),
                ],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'status' => config('response.codes.not_found'),
                'errors' => [
                    'message' => $exception->getMessage(),
                ],
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof NotFoundException) {
            return response()->json([
                'status' => $exception->getCode(),
                'errors' => [
                    'message' => $exception->getMessage(),
                ],
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'status' => config('response.codes.unauthenticated'),
                'errors' => [
                    'message' => $exception->getMessage(),
                ],
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'status' => config('response.codes.unauthorized'),
                'errors' => [
                    'message' => $exception->getMessage(),
                ],
            ], Response::HTTP_FORBIDDEN);
        }

        return response()->json([
            'status' => config('response.codes.internal_server_error'),
            'errors' => [
                'message' => 'production' === config('app.env') ? null : $exception->getMessage(),
            ],
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
