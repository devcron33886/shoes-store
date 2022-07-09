<aside>
    <h2 class="sr-only">Filters</h2>

    <!-- Mobile filter dialog toggle, controls the 'mobileFilterDialogOpen' state. -->
    <button type="button" class="inline-flex items-center lg:hidden">
        <span class="text-sm font-medium text-gray-700">Filters</span>
        <!-- Heroicon name: solid/plus-sm -->
        <svg class="flex-shrink-0 ml-1 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd"
                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                clip-rule="evenodd" />
        </svg>
    </button>

    <div class="hidden lg:block">
        <form class="divide-y divide-gray-200 space-y-10">


            <div class="pt-10">
                <fieldset>
                    <legend class="block text-sm font-medium text-gray-900">Category</legend>
                    <div class="pt-6 space-y-3">
                        @foreach ($categories as $category)
                        <div class="flex items-center">
                            <a href=""
                                class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                            {{ $category->name }}
                            </a>
                        </div>
                        @endforeach





                    </div>
                </fieldset>
            </div>


        </form>
    </div>
</aside>
