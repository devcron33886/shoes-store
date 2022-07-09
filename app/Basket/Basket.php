<?php

namespace App\Basket;

use App\Basket\Contracts\BasketInterface;
use App\Basket\Exceptions\QuantityNoLongerAvailable;
use App\Models\Cart;
use App\Models\User;
use App\Models\Variation;
use Cknow\Money\Money;
use Exception;
use Illuminate\Session\SessionManager;


class Basket implements BasketInterface
{
    protected $instance;

    public function __construct(protected SessionManager $session)
    {
    }

    public function exists(): bool
    {
        return $this->session->has(config('basket.session.key')) && $this->instance();
    }

    public function destroy()
    {
        $this->session->forget(config('basket.session.key'));
        $this->instance->delete();
    }

    public function associate(User $user)
    {
        $this->instance()->user()->associate($user);
        $this->instance()->save();
    }

    public function create(?User $user = null)
    {
        $instance = Cart::make();

        if ($user) {
            $instance->user()->associate($user);
        }
        $instance->save();

        $this->session->put(config('basket.session.key'), $instance->uuid);
    }

    public function add(Variation $variation, $quantity = 1)
    {
        if ($existingVariation = $this->getVariation($variation)) {
            $quantity += $existingVariation->pivot->quantity;
        }
        $this->instance()->variations()->syncWithoutDetaching([
            $variation->id => [
                'quantity' => min($quantity, $variation->stockCount())
            ]
        ]);
    }

    public function changeQuantity(Variation $variation, $quantity)
    {
        $this->instance()->variations()->updateExistingPivot($variation->id, ['quantity' => min($quantity, $variation->stockCount())]);
    }

    public function remove(Variation $variation)
    {
        $this->instance()->variations()->detach($variation);
    }

    public function isEmpty(): bool
    {
        return $this->contents()->count() === 0;
    }

    public function verifyAvailableQuantities()
    {
        $this->instance()->variations->each(
        /**
         * @throws Exception
         */
            function ($variation) {
                if ($variation->pivot->quantity > $variation->stocks->sum('amount')) {
                    throw new QuantityNoLongerAvailable('Stock Reduced');
                }
            });
    }

    public function syncAvailableQuantities()
    {
        $syncedQuantities = $this->instance()->variations->mapWithKeys(function ($variation) {
            $quantity = $variation->pivot->quantity > $variation->stocks->sum('count')
                ? $variation->stockCount() : $variation->pivot->quantity;

            return [
                $variation->id => [
                    'quantity' => $quantity
                ]
            ];

        })
            ->reject(function ($syncedQuantity) {
                return $syncedQuantity['quantity'] === 0;
            })->toArray();

        $this->instance()->variations()->sync($syncedQuantities);

        $this->clearInstanceCache();

    }

    public function removeAll()
    {
        $this->instance()->variations()->detach();
    }


    public function getVariation(Variation $variation)
    {
        return $this->instance()->variations->find($variation->id);
    }

    public function contents()
    {
        return $this->instance()->variations;
    }

    public function contentsCount()
    {
        return $this->contents()->count();
    }

    public function subtotal()
    {
        return $this->instance()->variations->reduce(function ($carry, $variation) {
            return $carry + ($variation->price * $variation->pivot->quantity);
        });

    }

    public function formattedSubtotal(): string
    {
        return Money::RWF($this->subtotal());
    }

    protected function clearInstanceCache()
    {
        $this->instance = null;
    }

    public function instance()
    {
        if ($this->instance) {
            return $this->instance;
        }
        return $this->instance = Cart::query()
            ->with('variations.product', 'variations.ancestorsAndSelf', 'variations.descendantsAndSelf.stocks', 'variations.media')
            ->whereUuid($this->session->get(config('basket.session.key')))->first();
    }
}
