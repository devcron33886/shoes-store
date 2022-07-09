<?php

namespace App\Http\Middleware;

use App\Basket\Contracts\BasketInterface;
use Closure;
use Illuminate\Http\Request;

class BasketMiddleware
{
    public function __construct(protected BasketInterface $basket)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        if (!$this->basket->exists()) {
            $this->basket->create();
        }
        return $next($request);
    }
}
