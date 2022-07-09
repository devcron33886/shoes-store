<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <main class="max-w-2xl mx-auto px-4 lg:max-w-7xl lg:px-8">


        <div class="pt-12 pb-24 lg:grid lg:grid-cols-3 lg:gap-x-8 xl:grid-cols-4">
            <div class="cols-1">
                <aside>
                    <h2 class="sr-only">Categories</h2>

                    <div class="hidden lg:block">
                        <div class="divide-y divide-gray-200 space-y-10">


                            <div class="pt-10">
                                <fieldset>
                                    <legend class="block text-lg font-medium text-gray-900">Categories</legend>
                                    <div class="pt-6 space-y-3">
                                        @foreach ($categories as $category)
                                            <div class="flex items-center">
                                                <a href="{{ route('category-show',$category->slug) }}"
                                                   class="ml-3 text-md text-gray-800"> {{ $category->name}} </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </fieldset>
                            </div>


                        </div>
                    </div>
                </aside>
            </div>

            <section aria-labelledby="product-heading" class="mt-6 lg:mt-0 lg:col-span-2 xl:col-span-3">
                <div class="mb-6 pt-4">
                    Found {{ $products->count() }} {{ Str::plural('product', $products->count()) }}
                </div>

                <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:gap-x-8 xl:grid-cols-3">
                    @foreach ($products as $product)
                        <a href="{{ route('product-show', $product->slug) }}"
                           class="p-6 bg-white border-b border-gray-200 space-y-4 mt-3">
                            <img src="{{ $product->getFirstMediaUrl() }}" class="w-full">
                            <div class="space-y-1">
                                <div class="font-semibold">{{ $product->name }}</div>
                                <div class="font-semibold text-sm">
                                    {{ $product->formattedPrice() }}
                                    /@foreach ($product->variations as $key => $variation)
                                        {{ $variation->type }}
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $products->links() }}
                </div>

            </section>
        </div>
    </main>

</x-app-layout>
