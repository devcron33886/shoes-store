<?php

namespace App\Http\Controllers;

use App\Basket\Contracts\BasketInterface;

use App\Basket\Exceptions\QuantityNoLongerAvailable;
use App\Http\Middleware\RedirectIfCartIsEmpty;


class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(RedirectIfCartIsEmpty::class);
    }

    public function __invoke(BasketInterface $basket)
    {
        try {

            $basket->verifyAvailableQuantities();
        } catch (QuantityNoLongerAvailable $e) {
            $basket->syncAvailableQuantities();
        }
        return view('shop.checkout');
    }
}
