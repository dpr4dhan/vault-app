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
                <div class="p-6 text-gray-900 dark:text-gray-100" x-data="{disabled : true}">
                    <form method="post" action="{{ route('items.update', $item->uuid) }}" class="mt-6 space-y-6" >
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="type" :value="__('Type')" />
                            <x-select id="type" name="type"  class="mt-1 block w-full" tabindex="0" x-bind:disabled="disabled">
                                @foreach($itemTypes as $type)
                                    <option value="{{ $type->value }}" {{old('type', $item->type) === $type->value ? 'selected' : '
'}}>{{ $type->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" autocomplete="title" value="{{ old('title', $item->title) }}" x-bind:disabled="disabled" x-ref="title"/>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" autocomplete="username" value="{{ old('username', $item->username) }}" x-bind:disabled="disabled"/>
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <div x-data="createForm()" @set-item-password.window="password=$event.detail">
                            <div class="flex justify-between">
                                <x-input-label for="password" :value="__('Password')" />
                                <div class="flex justify-items-end space-x-2">
                                    <x-secondary-button @click="show = (show === 'password' ? 'text' : 'password')" tabindex="-1">
                                        <i :class="show === 'password' ? 'far fa-eye' : 'far fa-eye-slash'"></i>
                                    </x-secondary-button>

                                    <x-secondary-button tabindex="-1"
                                                        title="Copy password"
                                                        @click="
                                                            copyToClipboard(password);
                                                            $dispatch('notice', {type: 'success', text: 'Copied successfully !'})
                                                        "
                                                       >
                                        <i class="far fa-copy"></i>
                                    </x-secondary-button>

                                    <x-secondary-button
                                        title="Password Generator"
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'password-generate')"
                                        tabindex="-1"
                                    >
                                        <i class="fas fa-sync"></i>
                                    </x-secondary-button>

                                    <x-secondary-button title="Check if password has been exposed" @click="leakPasswordChecker()" tabindex="-1">
                                        <template x-if="leaked">
                                            <i class="fas fa-times text-red-600"></i>
                                        </template>
                                        <template x-if="leaked===false">
                                            <i class="fas fa-check-double text-green-600"></i>
                                        </template>
                                        <template x-if="leaked===null">
                                            <i class="fas fa-check"></i>
                                        </template>

                                    </x-secondary-button>
                                </div>

                            </div>

                            <x-text-input id="password" name="password" x-bind:type="show" class="mt-1 block w-full" autocomplete="password" value="{{ old('password', $item->password) }}" x-model="password" x-bind:disabled="disabled"/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="url" :value="__('Url')" />
                            <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" autocomplete="url" value="{{ old('url', $item->url) }}" x-bind:disabled="disabled"/>
                            <x-input-error :messages="$errors->get('url')" class="mt-2" />
                        </div>

                        <div class="flex justify-between">
                            <x-input-label for="favourite" :value="__('Favourite')" />
                            <input id="favourite" name="favourite" type="checkbox" class="mt-1 block rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ old('favourite', $item->favourite) ? "checked" : '' }} x-bind:x-bind:disabled="disabled">
                        </div>

                        <div>
                            <x-input-label for="note" :value="__('Note')" />
                            <x-text-area id="note" name="note" rows="3" class="mt-1 block w-full" x-bind:disabled="disabled">{{ old('note', $item->note) }}</x-text-area>
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button x-bind:type="disabled ? 'button' : 'submit'" @click="disabled = !disabled;" >{{ __('Edit') }}</x-primary-button>
                            <x-danger-button type="button" >{{ __('Delete') }}</x-danger-button>
                        </div>
                    </form>
                    @include('items.partials.password-generate')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    function createForm(){
        return {
            password:"{{ $item->password }}",
            show: 'password',
            leaked: null,

            leakPasswordChecker(){
                axios.post("{{ route('items.leaked-password-check') }}", {
                    password: this.password,
                    _token: "{{ csrf_token() }}"
                })
                    .then((res) => {
                        this.leaked = res.data?.leaked;
                    }).catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },

            copyToClipboard(text){
                navigator.clipboard.writeText(text);
            }

        }

    }
</script>
