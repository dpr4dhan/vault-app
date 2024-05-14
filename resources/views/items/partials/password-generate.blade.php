<x-modal name="password-generate" focusable>
    <div class="p-6" x-data="generatorState()">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Password Generator') }}
        </h2>

        <div class="mt-6" >
            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

            <x-text-input
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-3/4"
                placeholder="{{ __('Password') }}"
                x-model="password"
            />
            <span x-text="password"></span>
        </div>

        <hr class="my-4">

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Options') }}</h2>

        <div class="mt-1">
            <x-input-label for="password" value="{{ __('Password Type') }}" />
            <x-select class="mt-1 block w-3/4" @change="password = getPassword()">
                <option value="password">Password</option>
                <option value="passphrase">Passphrase</option>
            </x-select>
        </div>
        <div class="mt-1">
            <x-input-label for="length" value="{{ __('Length') }}" />
            <x-text-input id="length" name="length" type="number" min="5" class="mt-1 block  w-3/4" autocomplete="url" value="5" />
        </div>

        <h4 class="mt-1 font-medium text-gray-900 dark:text-gray-100">{{ __('Include following') }}</h4>

        <div class="mt-1 border-b">
            <div class="flex justify-between">
                <x-input-label for="capital_letter" value="{{ __('A-Z') }}" />
                <input id="capital_letter" name="capital_letter" type="checkbox" class="mt-1 mb-1 block rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
            </div>
        </div>

        <div class="mt-1 border-b">
            <div class="flex justify-between">
                <x-input-label for="small_letter" value="{{ __('a-z') }}" />
                <input id="small_letter" name="small_letter" type="checkbox" class="mt-1 mb-1 block rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
            </div>
        </div>

        <div class="mt-1 border-b">
            <div class="flex justify-between">
                <x-input-label for="number" value="{{ __('0-9') }}" />
                <input id="number" name="number" type="checkbox" class="mt-1 mb-1 block rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
            </div>
        </div>

        <div class="mt-1 border-b">
            <div class="flex justify-between">
                <x-input-label for="character" value="{{ __('!@#$%^&*') }}" />
                <input id="character" name="character" type="checkbox" class="mt-1 mb-1 block rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('Done') }}
            </x-primary-button>
        </div>
    </div>
</x-modal>

<script type="text/javascript">
    function generatorState() {
        return {
            password: '',
            getPassword (){
                return 'passW0rd';
            }
        }
    }
</script>
