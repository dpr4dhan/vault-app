<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Items') }}
            </h2>

            <x-primary-atag href="{{ route('items.index') }}">Back to Listing</x-primary-atag>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('items.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="type" :value="__('Type')" />
                            <x-select id="type" name="type"  class="mt-1 block w-full">
                                @foreach($itemTypes as $type)
                                    <option value="{{ $type->value }}" {{old('type') === $type->value ? 'selected' : '
'}}>{{ $type->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" autocomplete="title" value="{{ old('title') }}"/>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" autocomplete="username" value="{{ old('username') }}"/>
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <div>
                            <div class="flex justify-between">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-secondary-button
                                    title="Password Generator"
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'password-generate')"
                                >
                                    <i class="fas fa-sync"></i>
                                </x-secondary-button>
                            </div>

                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="password" value="{{ old('password') }}"/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="url" :value="__('Url')" />
                            <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" autocomplete="url" />
                            <x-input-error :messages="$errors->get('url')" class="mt-2" value="{{ old('url') }}"/>
                        </div>

                        <div class="flex justify-between">
                            <x-input-label for="favourite" :value="__('Favourite')" />
                            <input id="favourite" name="favourite" type="checkbox" class="mt-1 block rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ old('favourite') ? "checked" : '' }}>
                        </div>

                        <div>
                            <x-input-label for="note" :value="__('Note')" />
                            <x-text-area id="note" name="note" rows="3" class="mt-1 block w-full" >{{ old('note') }}</x-text-area>
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                        </div>
                    </form>
                    @include('items.partials.password-generate')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
