<?php

namespace App\Http\Livewire;

use App\Basket\Contracts\BasketInterface;
use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\ShippingAddress;
use App\Models\ShippingType;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;


class CheckoutComponent extends Component
{

    public $shippingTypes;
    public $shippingTypeId;

    protected $shippingAddress;
    public $userShippingAddressId;

    public $paymentMethods;
    public $paymentMethodId;

    public $accountForm = [
        'email' => '',
    ];

    public $shippingForm = [
        'address' => '',
        'city' => '',
        'postcode' => '',
        'mobile' => '',
        'payment_method_id'=>'',
    ];

    protected $validationAttributes = [
        'accountForm.email' => 'Email address',
        'shippingForm.address' => 'Shipping address',
        'shippingForm.city' => 'Shipping city',
        'shippingForm.postcode' => 'Shipping postal code',
        'shippingForm.mobile' => 'Shipping mobile',
        'shippingForm.payment_method' => 'Payment method',

    ];

    protected $messages = [
        'accountForm.email.unique' => 'It seems you already have an account with this provided email. Please Sign in to place order.',
        'shippingForm.address.required' => 'Your :attribute is required',
        'shippingForm.city.required' => 'Your :attribute is required',
        'shippingForm.postcode.required' => 'Your :attribute is required',
        'shippingForm.mobile.required' => 'Your :attribute number is required',
        'shippingForm.payment_method.required' => 'Your :attribut is required',

    ];

    public function rules()
    {
        return [
            'accountForm.email' => 'required|email|max:255|unique:users,email' . (auth()->user() ? ',' . auth()->user()->id : ''),
            'shippingForm.address' => 'required|max:255',
            'shippingForm.city' => 'required|max:255',
            'shippingForm.postcode' => 'required|max:255',
            'shippingForm.mobile' => 'required|max:14|string',
            'shippingTypeId' => 'required|exists:shipping_types,id',
            'paymentMethodId' => 'required|exists:payment_methods,id'


        ];
    }

    public function updatedUserShippingAddressId($id)
    {
        if (!$id) {
            return;
        }
        $this->shippingForm = $this->userShippingAddresses->find($id)
            ->only('address', 'city', 'postcode', 'mobile');
    }

    public function getUserShippingAddressesProperty()
    {
        return auth()->user()?->shippingAddresses;
    }

    public function checkout(BasketInterface $basket)
    {
        $this->validate();
        $this->shippingAddress = ShippingAddress::query();
        if (auth()->user()) {
            $this->shippingAddress = $this->shippingAddress->whereBelongsTo(auth()->user());
        }
        ($this->shippingAddress = $this->shippingAddress->firstOrCreate($this->shippingForm))
            ?->user()
            ->associate(auth()->user())
            ->save();

        $order = Order::make(array_merge($this->accountForm, ['subtotal' => $basket->subtotal()
        ]));


        $order->user()->associate(auth()->user());
        $order->shippingType()->associate($this->shippingType);
        $order->paymentMethod()->associate($this->paymentMethodId);
        $order->shippingAddress()->associate($this->shippingAddress);
        $order->save();

        $order->variations()->attach($basket->contents()->mapWithKeys(function ($variation) {
            return [$variation->id => ['quantity' => $variation->pivot->quantity]];
        })->toArray());

        $basket->contents()->each(function ($variation) {
            $variation->stocks()->create([
                'amount' => 0 - $variation->pivot->quantity
            ]);
        });

        $basket->removeAll();
        Mail::to($order->email)->send(new OrderCreated($order));
        $users=User::where('is_admin',1)->get();
        Notification::send($users,new NewOrderNotification($order));
        $basket->destroy();

        if (!auth()->user()) {
            return redirect()->route('orders.conformation', $order);
        }
        return redirect()->route('orders');

    }

    public function mount()
    {
        $this->shippingTypes = ShippingType::orderBy('price', 'asc')->get();
        $this->shippingTypeId = $this->shippingTypes->first()->id;

        $this->paymentMethods=PaymentMethod::all();
        $this->paymentMethodId= $this->paymentMethods->first()->id;

        if ($user = auth()->user()) {
            $this->accountForm['email'] = $user->email;
        }

    }

    public function getShippingTypeProperty()
    {
        return $this->shippingTypes->find($this->shippingTypeId);
    }

    public function getPaymentMethodProperty()
    {
        return $this->paymentMethods->find($this->paymentMethodId);
    }

    public function getTotalProperty(BasketInterface $basket)
    {
        return $basket->subTotal() + $this->shippingType->price;
    }

    public function render(BasketInterface $basket): Factory|View|Application
    {

        return view('livewire.checkout-component', compact('basket'));
    }

}
