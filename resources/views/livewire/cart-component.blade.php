<main class="max-w-2xl mx-auto pt-16 pb-24 px-4 sm:px-6 lg:max-w-7xl lg:px-8">

    @if (!$basket->isEmpty())
        <div class="mt-12  lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start xl:gap-x-16">
            <section aria-labelledby="cart-heading" class="lg:col-span-7 bg-gray-50 shadow-sm rounded-lg">
                <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>
                <div role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                    @foreach($basket->contents() as $variation)
                        <livewire:cart-item-component :variation="$variation" :key="$variation->id"/>
                    @endforeach

                </div>
            </section>

            <!-- LatestProductScope summary -->
            <section aria-labelledby="summary-heading"
                     class="mt-16 bg-gray-50 rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5">
                <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>

                <dl class="mt-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <dt class="text-sm text-gray-600">Subtotal</dt>
                        <dd class="text-sm font-medium text-gray-900"> {{ $basket->formattedSubtotal() }}</dd>
                    </div>
                </dl>

                <div class="mt-6">
                    <a href="{{ route('shop.checkout') }}"
                            class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">
                        Checkout
                    </a>
                </div>
            </section>
        </div>
    @else
        <div class="p-6 mt-4 bg-white shadow-md rounded-lg border-b border-gray-200">
            Your cart is empty!
        </div>

    @endif

</main>
