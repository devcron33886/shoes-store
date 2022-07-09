<div class="mt-4 flow-root">
    <div class="-my-2">
        <div class="box-content py-2 relative h-80 overflow-x-auto xl:overflow-visible">
            <div class="absolute min-w-screen-xl px-4 flex space-x-8 sm:px-6 lg:px-8 xl:relative xl:px-0 xl:space-x-0 xl:grid xl:grid-cols-5 xl:gap-x-8">
                <a href="{{ route('category-show', $category->slug) }}"
                    class="{{ $category->depth === 0 ? 'font-bold' : '' }}"
                    class="relative w-56 h-80 rounded-lg p-6 flex flex-col overflow-hidden hover:opacity-75 xl:w-auto">
                    <span aria-hidden="true" class="absolute inset-0">
                        <img src="https://tailwindui.com/img/ecommerce-images/home-page-01-category-01.jpg"
                            alt="" class="w-full h-full object-center object-cover">
                    </span>
                    <span aria-hidden="true"
                        class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-gray-800 opacity-50"></span>
                    <span
                        class="relative mt-auto text-center text-xl font-bold text-white">{{ $category->name }}</span>
                </a>

            </div>
        </div>
    </div>
</div>
