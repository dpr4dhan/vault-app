<x-modal name="password-generate" focusable>
    <div class="p-6" x-data="generatorState()">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Password Generator') }}
        </h2>

        <div class="mt-6" >
            <x-input-label for="modalPassword" value="{{ __('Password') }}" class="sr-only" />
            <div class="flex justify-between" x-data="{ show: 'password'}">

                <x-text-input
                    id="modalPassword"
                    x-bind:type="show"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                    x-model="modalPassword"
                />
                <x-secondary-button @click="show = (show === 'password' ? 'text' : 'password')">
                    <i :class="show === 'password' ? 'far fa-eye' : 'far fa-eye-slash'"></i>
                </x-secondary-button>
                <x-secondary-button tabindex="-1"
                                    title="Copy password"
                                    @click="copyToClipboard(modalPassword);
                                                $dispatch('notice', {type: 'success', text: 'Copied successfully !'})
                                            "
                >
                    <i class="far fa-copy"></i>
                </x-secondary-button>
            </div>


        </div>

        <hr class="my-4">

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Options') }}</h2>

        <div class="mt-1">
            <x-input-label for="password" value="{{ __('Password Type') }}" />
            <x-select class="mt-1 block w-3/4" @change="getPassword()">
                <option value="password">Password</option>
                <option value="passphrase">Passphrase</option>
            </x-select>
        </div>
        <div class="mt-1">
            <x-input-label for="length" value="{{ __('Length') }}" />
            <x-text-input id="length" name="length" type="number" min="5" class="mt-1 block  w-3/4" autocomplete="url" value="5" x-model="length" @change="password = getPassword()"/>
        </div>

        <h4 class="mt-1 font-medium text-gray-900 dark:text-gray-100">{{ __('Include following') }}</h4>

        <div class="mt-1 border-b">
            <div class="flex justify-between">
                <x-input-label for="letter" value="{{ __('A-Za-z') }}" />
                <input id="letter" name="letter" type="checkbox" class="mt-1 mb-1 block rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" x-model="letter" @change="getPassword()" disabled>
            </div>
        </div>

        <div class="mt-1 border-b">
            <div class="flex justify-between">
                <x-input-label for="number" value="{{ __('0-9') }}" />
                <input id="number" name="number" type="checkbox" class="mt-1 mb-1 block rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" x-model="number" @change="getPassword()">
            </div>
        </div>

        <div class="mt-1 border-b">
            <div class="flex justify-between">
                <x-input-label for="character" value="{!! __('!@#$%^&*') !!}" />
                <input id="character" name="character" type="checkbox" class="mt-1 mb-1 block rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" x-model="character" @change="getPassword()">
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button type="button" x-on:click="$dispatch('close')" tabindex="-1">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button type="button" class="ms-3"
                              x-on:click="$dispatch('set-item-password', modalPassword); $dispatch('close')"
                              tabindex="-1"
            >
                {{ __('Done') }}
            </x-primary-button>
        </div>
    </div>
</x-modal>

<script type="text/javascript">
    function generatorState() {
        return {
            modalPassword: '{!! str()->password(8) !!}',
            passwordType: '',
            length: 8,
            letter: true,
            number: true,
            character: true,

            getPassword (){
                axios.post("{{ route('items.password-generator') }}", {
                    letter: this.letter,
                    length: this.length,
                    number: this.number,
                    character: this.character,
                    _token: "{{ csrf_token() }}"
                })
                .then((res) => {
                    this.modalPassword = res.data.password;
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
