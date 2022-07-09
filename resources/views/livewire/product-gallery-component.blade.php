<div class="lg:row-end-1 lg:col-span-4">
    <div class="aspect-w-4 aspect-h-3 rounded-lg bg-gray-100 overflow-hidden">
        <img src="{{ $selectedImageUrl }}"
             alt="{{ $product->name }}."
             class="object-center object-cover" style="width: 100%;">
    </div>
    <div class="grid grid-cols-6 gap-2">
        @foreach($product->getMedia() as $media)
            <button wire:click="selectImage('{{ $media->getUrl() }}')">
                <img src="{{ $media->getUrl('thumb250X250') }}" alt="">
            </button>
        @endforeach
    </div>
</div>
