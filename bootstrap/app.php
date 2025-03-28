<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            ]);
            $middleware->validateCsrfTokens(
                except: ['/*']
            );
        })
        ->withExceptions(function (Exceptions $exceptions) {
        
            $exceptions->renderable(function (AuthenticationException $exception) {
                return response()->json($exception->getMessage(),401);
            });
    
            $exceptions->renderable(function (AuthorizationException $exception) {
                return response()->json($exception->getMessage(),401);
            });  
            
            $exceptions->renderable(function (TokenMismatchException $exception) {
                return response()->json($exception->getMessage(),401);
            });  
    
            $exceptions->renderable(function (ValidationException $exception) {
                return response()->json($exception->errors(),422);
            });
            
            $exceptions->renderable(function (ModelNotFoundException $exception) {
                return response()->json($exception->getMessage(),422);
            });
    
            $exceptions->renderable(function (HttpException $exception) {
                return response()->json($exception->getMessage(),404);
            });
    
            $exceptions->renderable(function (Exception $exception) {
                $response = [
                    'message' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                ];
                return response()->json($response,500);
            });
    
    })->create();
