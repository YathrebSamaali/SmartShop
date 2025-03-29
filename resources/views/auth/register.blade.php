<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name and Email on the same line -->
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Name -->
            <div class="w-full md:w-1/2">
                <div class="flex items-center">
                    <x-input-label for="name" :value="__('Name')" class="text-white mr-2" />
                    <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="w-full md:w-1/2">
                <div class="flex items-center">
                    <x-input-label for="email" :value="__('Email')" class="text-white mr-2" />
                    <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Password and Confirm Password on the same line -->
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Password -->
            <div class="w-full md:w-1/2">
                <div class="flex items-center">
                    <x-input-label for="password" :value="__('Password')" class="text-white mr-2" />
                    <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="w-full md:w-1/2">
                <div class="flex items-center">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white mr-2" />
                    <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Address -->
        <div>
            <div class="flex items-center">
                <x-input-label for="address" :value="__('Address')" class="text-white mr-2" />
                <x-text-input id="address" class="block w-full" type="text" name="address" :value="old('address')" />
            </div>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Postal Code and Phone Number on the same line -->
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Postal Code -->
            <div class="w-full md:w-1/2">
                <div class="flex items-center">
                    <x-input-label for="postal_code" :value="__('Postal Code')" class="text-white mr-2" />
                    <x-text-input id="postal_code" class="block w-full" type="text" name="postal_code" :value="old('postal_code')" />
                </div>
                <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="w-full md:w-1/2">
                <div class="flex items-center">
                    <x-input-label for="phone_number" :value="__('Phone Number')" class="text-white mr-2" />
                    <x-text-input id="phone_number" class="block w-full" type="text" name="phone_number" :value="old('phone_number')" />
                </div>
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>
        </div>

        <!-- Bottom Section: Buttons and Link to Login -->
        <div class="flex flex-col-reverse md:flex-row justify-between items-center mt-6 gap-4">
            <!-- Link to Login Page -->
            <a href="{{ route('login') }}" class="text-sm text-white hover:text-gray-300 underline">
                {{ __('Already have an account? Log in') }}
            </a>

            <!-- Register Button -->
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
