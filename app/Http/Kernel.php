<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
  // ...

  protected $middlewareGroups = [
    'web' => [
      // middleware web lainnya
    ],
    'api' => [
      // middleware api lainnya
    ],
  ];

  protected $routeMiddleware = [
    // middleware default Laravel
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
  ];
}
