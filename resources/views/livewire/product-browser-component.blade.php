<div class="max-auto sm:px-6 lg:px-8 max-w-7xl py-12 grid grid-cols-6 gap-4">
    <div class="col-span-1">
        <div class="space-y-6">
            <div class="space-y-1">
                <ul>
                    @foreach ($category->children as $child)
                        <li> <a href="{{ route('category-show', $category->slug) }}" class="text-indigo-500">
                                {{ $child->name }}</a></li>
                    @endforeach

                </ul>
            </div>

            <div class="space-y-6">
                @if ($category->products->count())
                    <div class="space-y-1">

                        <div class="font-semibold">Max price (RWF {{ number_format($priceRange['max']) }})</div>
                        <div class="flex items-center space-x-2">
                            <input type="range" min="0" max="{{ $maxPrice }}" wire:model="priceRange.max">
                        </div>
                    </div>
                @endif

                @if ($products->count())
                    @foreach ($filters as $title => $filter)
                        <div class="space-y-1">
                            <div class="font-semibold">{{ Str::title($title) }}</div>
                            @foreach ($filter as $option => $count)
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" wire:model="queryFilters.{{ $title }}"
                                        id="{{ $title }}_{{ strtolower($option) }}"
                                        value="{{ $option }}">
                                    <label
                                        for="{{ $title }}_{{ strtolower($option) }}">{{ $option }}({{ $count }})</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif


            </div>
        </div>
    </div>
    <div class="col-span-5 sm:px-6 lg:px-8">
        <div class="mb-6">
            Found {{ $products->count() }} {{ Str::plural('product', $products->count()) }} Matching your filters
        </div>
        <div class="overflow-hiden sm:rounded-lg grid lg:grid-cols-3 md:cols-2 gap-4">
            @foreach ($products as $product)
                <a href="{{ route('product-show', $product->slug) }}"
                    class="p-6 bg-white border-b border-gray-200 space-y-4">
                    <img src="{{ $product->getFirstMediaUrl() }}" class="w-full">
                    <div class="space-y-1">
                        <div>{{ $product->name }}</div>
                        <div class="font-semibold text-lg">
                            {{ $product->formattedPrice() }}
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
</div>
