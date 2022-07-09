<form autocomplete="off" wire:submit.prevent="checkout">
    <div class="overflow-hidden sm:rounded-lg grid grid-cols-6 grid-flow-col gap-4">
        <div class="p-6 bg-white border-b border-gray-200 col-span-3 self-start space-y-6">
            @guest
                <div class="space-y-3">
                    <div class="font-semibold text-lg">Account details</div>
                    <div>
                        <label for="email">Email</label>
                        <x-input class="block mt-1 w-full" id="email" type="text" name="email"
                                 wire:model.defer="accountForm.email"/>
                        @error('accountForm.email')
                        <div class="mt-2 font-semibold text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            @endguest

            <div class="space-y-3">
                <div class="font-semibold text-lg">Shipping</div>
                @if($this->userShippingAddresses)
                    <x-select class="w-full" wire:model="userShippingAddressId">
                        <option value="">Choose pre-saved address</option>
                        @foreach($this->userShippingAddresses as $address)
                            <option value="{{ $address->id }}">{{$address->formattedAddress()}}</option>

                        @endforeach
                    </x-select>

                @endif

                <div class="space-y-3">
                    <div>
                        <label for="address">Address</label>
                        <x-input id="address" class="block mt-1 w-full" wire:model.defer="shippingForm.address"
                                 type="text" name="address"/>

                        @error('shippingForm.address')
                        <div class="mt-2 font-semibold text-red-600">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <label for="city">City</label>
                            <x-input class="block mt-1 w-full" wire:model.defer="shippingForm.city" id="city"
                                     type="text" name="city"/>
                            @error('shippingForm.city')
                            <div class="mt-2 font-semibold text-red-600">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-span-1">
                            <label for="postcode">Postal code</label>
                            <x-input class="block mt-1 w-full" wire:model.defer="shippingForm.postcode" id="postcode"
                                     type="text" name="postcode"/>
                            @error('shippingForm.postcode')
                            <div class="mt-2 font-semibold text-red-600">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <div class="font-semibold text-lg">Delivery</div>
                <div class="space-y-1">
                    <x-select class="w-full" wire:model="shippingTypeId">
                        @foreach($shippingTypes as $shippingType)
                            <option value="{{ $shippingType->id }}">{{$shippingType->title}}
                                (RWF {{ number_format($shippingType->price) }})
                            </option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="space-y-3">
                <div class="font-semibold text-lg">Choose Payment Method</div>
                <div class="space-y-1">
                    <x-select class="w-full" wire:model="paymentMethodId">
                        @foreach($paymentMethods as $paymentMethod)
                            <option value="{{ $paymentMethod->id }}">{{$paymentMethod->name}}

                            </option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="space-y-3">
                <div class="font-semibold text-lg">Mobile Number</div>
                <div class="space-y-1">
                    <x-input class="block mt-1 w-full" wire:model.defer="shippingForm.mobile" id="mobile"
                             type="text" name="mobile"/>
                    @error('shippingForm.mobile')
                    <div class="mt-2 font-semibold text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="p-6 bg-white border-b border-gray-200 col-span-3 self-start space-y-4">
            <div>
                @foreach ($basket->contents() as $variation)
                    <div class="border-b py-3 flex items-start">
                        <div class="w-16 mr-4">
                            <img src="{{ $variation->getFirstMediaUrl('default', 'thumb300X300') }}"
                                 class="w-16">
                        </div>

                        <div class="space-y-2">
                            <div>
                                <div class="font-semibold">
                                    RWF {{ number_format($variation->price) }}
                                </div>
                                <div class="space-y-1">
                                    <div>{{ $variation->product->name }}</div>

                                    <div class="flex items-center text-sm">
                                        <div class="mr-1 font-semibold">
                                            Quantity: {{ $variation->pivot->quantity }}
                                            <span class="text-gray-400 mx-1">/</span>
                                        </div>
                                        @foreach ($variation->ancestorsAndSelf as $ancestor)
                                            {{ $ancestor->name }}
                                            @if (!$loop->last)
                                                <span class="text-gray-400 mx-1">/</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="space-y-4">
                <div class="space-y-1">
                    <div class="space-y-1 flex items-center justify-between">
                        <div class="font-semibold">Subtotal</div>
                        <h1 class="font-semibold">RWF {{number_format($basket->subTotal())}}</h1>
                    </div>

                    <div class="space-y-1 flex items-center justify-between">
                        <div class="font-semibold">Shipping ({{$this->shippingType->title}})</div>
                        <h1 class="font-semibold">RWF {{ number_format($this->shippingType->price) }}</h1>
                    </div>

                    <div class="space-y-1 flex items-center justify-between">
                        <div class="font-semibold">Total</div>
                        <h1 class="font-semibold">RWF {{ number_format($this->total) }}</h1>
                    </div>
                </div>

                <button
                    class="inline-flex items-center bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">
                    CONFIRM ORDER AND PAY
                </button>
            </div>
        </div>
    </div>
</form>
