<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your order(s)
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg space-y-3">
                @forelse($orders as $order)
                    <div class="bg-white p-6 col-span-4 space-y-3">

                        <div class="border-b pb-3 flex items-center justify-between">
                            <div>#{{ $order->id }}</div>
                            <div>RWF {{ number_format( $order->subtotal) }}</div>
                            <div>{{ $order->shippingtype->title }}</div>
                            <div>{{ $order->placed_at->toDateTimeString() }}</div>
                            <div>{{ $order->paymentMethod->name }}</div>
                            <div>
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm rounded-full font-semibold bg-green-500 text-white">
                                    {{ $order->presenter()->status() }}
                                </span>
                            </div>
                        </div>
                        @foreach($order->variations as $variation)
                            <div class="border-b py-3 space-y-2 flex items-center last:border-0 las:pb-0">
                                <div class="w-16 mr-4">
                                    <img src="{{ $variation->getFirstMediaUrl('default','thumb300X300') }}" class="w-16" alt="">
                                </div>
                                <div class="space-y-1">
                                    <div>
                                        <div class="font-semibold">RWF {{ number_format($variation->price) }}</div>
                                        <div>{{ $variation->product->name }}</div>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <div class="mr-1 font-semibold">
                                            Quantity: {{ $variation->pivot->quantity }}<span class="text-gray-700 mx-1">/</span>
                                        </div>
                                        @foreach($variation->ancestorsAndSelf as $ancestor)
                                            {{ $ancestor->type }} @if(!$loop->last)
                                                <span class="text-gray-700 mx-1">/</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @empty
                    Currently you have no orders
                @endforelse
            </div>
        </div>


    </div>
</x-app-layout>
