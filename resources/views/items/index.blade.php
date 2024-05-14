<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Items') }}
            </h2>

            <x-primary-atag href="{{ route('items.create') }}">Add New Item</x-primary-atag>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul role="list" class="divide-y divide-gray-100">
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-200">Leslie Alexander</p>
                                    <p class="mt-1 truncate text-xs leading-5 text-gray-500 dark:text-gray-400">leslie.alexander@example.com</p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm leading-6 text-gray-900 dark:text-gray-200">Co-Founder / CEO</p>
                                <p class="mt-1 text-xs leading-5 text-gray-500 dark:text-gray-400">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
