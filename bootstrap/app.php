
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

use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;


return Application::configure(basePath: dirname(__DIR__))

    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */

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

        $middleware->prepend(ApiLocalization::class);

        $middleware->redirectGuestsTo(function (Request $request) {

        if ($request->is('api/*')) {
            return null;
        }

        return '/login';
    });

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
        | JWT Authentication Exceptions
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            JWTException $e,
            Request $request
        ) use ($responder) {

            if (!$request->is('api/*')) {
                return null;
            }

            $messageKey = match (true) {

                $e instanceof TokenExpiredException
                    => 'errors.token_expired',

                $e instanceof TokenBlacklistedException
                    => 'errors.token_blacklisted',

                $e instanceof TokenInvalidException
                    => 'errors.token_invalid',

                default
                    => 'errors.token_authentication_failed',
            };

            return $responder->respondError(
                __($messageKey),
                null,
                401
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
            |--------------------------------------------------------------------------
            | Determine HTTP Status
            |--------------------------------------------------------------------------
            */

            $status = match (true) {

                $e instanceof AuthenticationException
                    => 401,

                $e instanceof AuthorizationException
                    => $e->status() ?? 403,

                $e instanceof ModelNotFoundException
                    => 404,

                $e instanceof HttpExceptionInterface
                    => $e->getStatusCode(),

                default
                    => 500,
            };

            /*
            |--------------------------------------------------------------------------
            | Distinguish Missing Models From Missing Routes
            |--------------------------------------------------------------------------
            */

            $isModelNotFound =
                $e instanceof ModelNotFoundException
                ||
                (
                    $e instanceof NotFoundHttpException
                    &&
                    $e->getPrevious() instanceof ModelNotFoundException
                );

            /*
            |--------------------------------------------------------------------------
            | Determine Translated Message
            |--------------------------------------------------------------------------
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

                default
                    => 'errors.request_failed',
            };

            /*
            |--------------------------------------------------------------------------
            | Unified Error Response
            |--------------------------------------------------------------------------
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
