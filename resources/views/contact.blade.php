<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white">
                <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                    <div class="max-w-lg mx-auto md:max-w-none md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">Sales Support</h2>
                            <div class="mt-3">
                                <p class="text-lg text-gray-500">Nullam risus blandit ac aliquam justo ipsum. Quam mauris
                                    volutpat massa dictumst amet. Sapien tortor lacus arcu.</p>
                            </div>
                            <div class="mt-9">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/phone -->
                                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-base text-gray-500">
                                        <p>+1 (555) 123 4567</p>
                                        <p class="mt-1">Mon-Fri 8am to 6pm PST</p>
                                    </div>
                                </div>
                                <div class="mt-6 flex">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/mail -->
                                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-base text-gray-500">
                                        <p>support@example.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-12 sm:mt-16 md:mt-0">
                            <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">Technical Support</h2>
                            <div class="mt-3">
                                <p class="text-lg text-gray-500">Lorem, ipsum dolor sit amet consectetur adipisicing
                                    elit. Magni, repellat error corporis doloribus similique, voluptatibus numquam quam,
                                    quae officiis facilis.</p>
                            </div>
                            <div class="mt-9">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/phone -->
                                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-base text-gray-500">
                                        <p>+1 (555) 123 4567</p>
                                        <p class="mt-1">Mon-Fri 8am to 6pm PST</p>
                                    </div>
                                </div>
                                <div class="mt-6 flex">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/mail -->
                                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-base text-gray-500">
                                        <p>support@example.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
