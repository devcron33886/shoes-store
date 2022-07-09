<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:cart-component/>

            <!-- Related products -->
            <section aria-labelledby="related-heading" class="mt-10">
                <h2 id="related-heading" class="text-lg font-medium text-gray-900">You may also like&hellip;</h2>

                <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach($products as $product)
                        <div class="group relative">
                            <div
                                class="w-full min-h-80 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                                <img src="{{ $product->getFirstMediaUrl() }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                            </div>
                            <div class="mt-4 flex justify-between">
                                <div>
                                    <h3 class="text-sm text-gray-700">
                                        <a href="{{ route('product-show',$product->slug) }}">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{ $product->name }}
                                        </a>
                                    </h3>

                                </div>
                                <p class="text-sm font-medium text-gray-900">{{ $product->formattedPrice() }}</p>
                            </div>
                        </div>

                    @endforeach

                    <!-- More products... -->
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
