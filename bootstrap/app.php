<?php

use App\Http\Middleware\ApiLocalization;
use App\Http\Traits\ApiResponserTrait;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    */

    ->withMiddleware(function (Middleware $middleware): void {

        // ضبط اللغة مبكرًا لجميع الطلبات
        $middleware->prepend(ApiLocalization::class);
    })

    /*
    |--------------------------------------------------------------------------
    | Exception Handling
    |--------------------------------------------------------------------------
    */

    ->withExceptions(function (Exceptions $exceptions): void {



        /*
        |--------------------------------------------------------------------------
        | Unified API Responder
        |--------------------------------------------------------------------------
        */

        $responder = new class {
            use ApiResponserTrait {
                errorResponse as public respondError;
            }
        };

        /*
        |--------------------------------------------------------------------------
        | Validation Exceptions
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            ValidationException $e,
            Request $request
        ) use ($responder) {



            if (!$request->is('api/*')) {
                return null;
            }

            return $responder->respondError(
                __('errors.validation_failed'),
                $e->errors(),
                422
            );
        });

        /*
        |--------------------------------------------------------------------------
        | General API Exceptions
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            Throwable $e,
            Request $request
        ) use ($responder) {

            if (!$request->is('api/*')) {
                return null;
            }

            /*
            |--------------------------------------------------------------
            | Determine HTTP Status
            |--------------------------------------------------------------
            */

            $status = match (true) {

                $e instanceof AuthenticationException => 401,

                $e instanceof AuthorizationException =>
                $e->status() ?? 403,

                $e instanceof HttpExceptionInterface =>
                $e->getStatusCode(),

                $e instanceof ModelNotFoundException => 404,
                503 => 'errors.service_unavailable',
                default => 'errors.internal_server_error',

                
            };


            $isModelNotFound =
                $e instanceof ModelNotFoundException ||
                (
                    $e instanceof NotFoundHttpException &&
                    $e->getPrevious() instanceof ModelNotFoundException
                );

            /*
            |--------------------------------------------------------------
            | Determine Translated Message
            |--------------------------------------------------------------
            */

            $messageKey = match (true) {
                $status === 404 && $isModelNotFound
                => 'errors.resource_not_found',

                $status === 404
                => 'errors.route_not_found',

                $status === 400
                => 'errors.bad_request',

                $status === 401
                => 'errors.unauthenticated',

                $status === 403
                => 'errors.forbidden',

                $status === 405
                => 'errors.method_not_allowed',

                $status === 409
                => 'errors.conflict',

                $status === 419
                => 'errors.session_expired',

                $status === 422
                => 'errors.validation_failed',

                $status === 429
                => 'errors.too_many_requests',

                $status === 503
                => 'errors.service_unavailable',

                $status >= 500
                => 'errors.internal_server_error',

                503 => 'errors.service_unavailable',
                default => 'errors.internal_server_error',
            };
            /*
            |--------------------------------------------------------------
            | Unified Error Response
            |--------------------------------------------------------------
            */

            return $responder->respondError(
                __($messageKey),
                null,
                $status
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Force JSON Responses For API
        |--------------------------------------------------------------------------
        */

        $exceptions->shouldRenderJsonWhen(function (
            Request $request,
            Throwable $e
        ) {
            return $request->is('api/*')
                || $request->expectsJson();
        });
    })

    ->create();
