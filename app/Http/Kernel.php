<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
protected $routeMiddleware = [
    // ... middleware lain di atasnya ...

    // TAMBAHKAN INI:
    'role.access' => \App\Http\Middleware\EnsureUserRole::class, 
];

}