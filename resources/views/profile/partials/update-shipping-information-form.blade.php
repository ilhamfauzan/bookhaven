<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Shipping Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's shipping information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        
        <div>
            <x-input-label for="shipping_address" :value="__('Address')" />
            <x-text-input id="shipping_address" name="shipping_address" type="text" class="mt-1 block w-full" :value="old('shipping_address', $user->shipping_address)" required />
            <x-input-error class="mt-2" :messages="$errors->get('shipping_address')" />
        </div>

        <div>
            <x-input-label for="shipping_phone_number" :value="__('Phone Number')" />
            <x-text-input id="shipping_phone_number" name="shipping_phone_number" type="text" class="mt-1 block w-full" :value="old('shipping_phone_number', $user->shipping_phone_number)" required />
            <x-input-error class="mt-2" :messages="$errors->get('shipping_phone_number')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

