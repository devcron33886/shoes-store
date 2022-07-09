<x-app-layout>
    <div class="border-b bg-white border-gray-200">
        <nav aria-label="Breadcrumb" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <ol role="list" class="flex items-center space-x-4 py-4">
                <li>
                    <div class="flex items-center">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            <a href="#" class="mr-4 font-medium text-gray-900">
                                {{ $category->name }}
                            </a>
                        </h2>

                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <main class="max-w-2xl mx-auto px-4 lg:max-w-7xl lg:px-8">


        <div class="pt-12 pb-24 lg:grid lg:grid-cols-4 lg:gap-x-8 xl:grid-cols-4">

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
                                <div>{{ $product->name }}</div>
                                <div class="font-semibold text-lg">
                                    {{ $product->formattedPrice() }}/@foreach ($product->variations as $key => $variation)
                                        {{ $variation->type }}
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                {{ $products->links() }}
            </section>
        </div>
    </main>
</x-app-layout>
