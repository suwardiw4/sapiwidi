<?php

// use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// WAJIB TAMBAHKAN DUA BARIS IMPORT DI BAWAH INI
// use Illuminate\Session\TokenMismatchException;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException; // Wajib di-import

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'guest' => \App\Http\Middleware\Guest::class,
            'auth' => \App\Http\Middleware\Auth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Tangkap HttpException karena Laravel mengubah TokenMismatchException menjadi HttpException (419)
        $exceptions->render(function (HttpException $e) {
            if ($e->getStatusCode() === 419) {
                return redirect()
                    ->route('login')
                    ->with('error', 'Sesi Anda telah berakhir, silakan login kembali.');
            }
        });
    })->create();
