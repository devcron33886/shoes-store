<?php

namespace App\Http\Middleware;

use App\Basket\Contracts\BasketInterface;
use Closure;
use Illuminate\Http\Request;


class RedirectIfCartIsEmpty
{

    public function __construct(protected BasketInterface $basket)
    {
    }


    public function handle(Request $request, Closure $next)
    {
        if ($this->basket->isEmpty())
        {
            return redirect()->route('shop');
        }
        return $next($request);
    }
}
