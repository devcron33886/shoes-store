<x-app-layout>
    <div class="relative bg-gray-900">
        <!-- Decorative image and overlay -->
        <div aria-hidden="true" class="absolute inset-0 overflow-hidden">
            <img src="{{ asset('images/Sliders/1.jpg') }}" alt=""
                 class="w-full h-full object-center object-cover">
        </div>
        <div aria-hidden="true" class="absolute inset-0 bg-gray-900 opacity-50"></div>


        <div class="relative max-w-3xl mx-auto py-32 px-6 flex flex-col items-center text-center sm:py-64 lg:px-0">
            <h1 class="text-4xl font-extrabold tracking-tight text-white lg:text-6xl">Welcome to Garden of Eden Rwanda
            </h1>
            <p class="mt-4 text-xl text-white">We are here to serve you the best fresh groceries.</p>
            <a href="{{ route('shop') }}"
               class="mt-8 inline-block bg-white border border-transparent rounded-md py-3 px-8 text-base font-medium text-gray-900 hover:bg-gray-100">Shop
                New Arrivals
            </a>
        </div>
    </div>

    <section aria-labelledby="category-heading" class="pt-24 sm:pt-32 xl:max-w-7xl xl:mx-auto xl:px-8">
        <div class="px-4 sm:px-6 sm:flex sm:items-center sm:justify-between lg:px-8 xl:px-0">
            <h2 id="category-heading" class="text-2xl font-extrabold tracking-tight text-gray-900">Shop by Category
            </h2>

        </div>
        <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:gap-x-8 xl:grid-cols-5">
            @foreach ($categories as $category)
                <a href="{{ route('category-show', $category->slug) }}"
                   class="p-6 bg-white border-b border-gray-200 space-y-4 mt-3">
                    <img src="{{ $category->getFirstMediaUrl() }}" class="w-full">
                    <div class="space-y-1">
                        <div class="font-semibold">{{ $category->name }}</div>

                    </div>
                </a>
            @endforeach
        </div>

    </section>
    <!-- Featured section -->

    <section aria-labelledby="social-impact-heading" class="max-w-7xl mx-auto pt-4 px-4 sm:pt-32 sm:px-6 lg:px-8">
        <div class="relative rounded-lg overflow-hidden">
            <div class="absolute inset-0">
                <img src="{{ asset('images/Sliders/g14.jpg') }}" alt=""
                     class="w-full h-full object-center object-cover">
            </div>
            <div class="relative bg-gray-900 bg-opacity-75 py-8 px-6 sm:py-40 sm:px-12 lg:px-16">
                <div class="relative max-w-3xl mx-auto flex flex-col items-center text-center">
                    <h2 id="social-impact-heading"
                        class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                        <span class="block sm:inline">About us</span>

                    </h2>
                    <p class="mt-3 text-xl text-white">GARDEN OF EDEN PRODUCE is a Rwandan company which organically
                        grows and deliver variety of fresh groceries (fruits, vegetables and herbs) mostly those
                        which were unavailable on Rwandan market before. And mainly we focus on veggies, fruits and
                        herbs with tremendous healthy benefits. By experience gained from our father who was in this
                        business 40 years the quality of our groceries is guaranteed.</p>
                    <a href="{{ route('shop') }}"
                       class="mt-8 w-full block bg-white border border-transparent rounded-md py-3 px-8 text-base font-medium text-gray-900 hover:bg-gray-100 sm:w-auto">Shop</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured section -->
    <section aria-labelledby="category-heading" class="pt-24 sm:pt-32 xl:max-w-7xl xl:mx-auto xl:px-8">
        <div class="px-4 sm:px-6 sm:flex sm:items-center sm:justify-between lg:px-8 xl:px-0">
            <h2 id="category-heading" class="text-2xl font-extrabold tracking-tight text-gray-900">Latest products
            </h2>

        </div>
        <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:gap-x-8 xl:grid-cols-5">
            @foreach ($products as $product)
                <a href="{{ route('product-show', $product->slug) }}"
                   class="p-6 bg-white border-b border-gray-200 space-y-4 mt-3">
                    <img src="{{ $product->getFirstMediaUrl() }}" class="w-full">
                    <div class="space-y-1">
                        <div class="font-semibold">{{ $product->name }}</div>

                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-4">
            <a href="{{ route('shop') }}" class="text-indigo-800 font-bold">See all products</a>
        </div>

    </section>


</x-app-layout>
