<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}" class="space-y-6 mx-4 sm:mx-6">
        @csrf

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-text-input id="name" class="w-full rounded-lg bg-gray-700/80 border-gray-600/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400"
                            type="text" name="name" :value="old('name')" required autofocus placeholder="Full Name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Email -->
            <div>
                <x-text-input id="email" class="w-full rounded-lg bg-gray-700/80 border-gray-600/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400"
                            type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email Address" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Password -->
            <div>
                <x-text-input id="password" class="w-full rounded-lg bg-gray-700/80 border-gray-600/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400"
                            type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-text-input id="password_confirmation" class="w-full rounded-lg bg-gray-700/80 border-gray-600/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400"
                            type="password" name="password_confirmation" required placeholder="Confirm Password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Address (full width) -->
            <div class="md:col-span-2">
                <x-text-input id="address" class="w-full rounded-lg bg-gray-700/80 border-gray-600/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400"
                            type="text" name="address" :value="old('address')" placeholder="Street Address" />
                <x-input-error :messages="$errors->get('address')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Postal Code -->
            <div>
                <x-text-input id="postal_code" class="w-full rounded-lg bg-gray-700/80 border-gray-600/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400"
                            type="text" name="postal_code" :value="old('postal_code')" placeholder="Postal Code" />
                <x-input-error :messages="$errors->get('postal_code')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Phone Number -->
            <div>
                <x-text-input id="phone_number" class="w-full rounded-lg bg-gray-700/80 border-gray-600/50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-400"
                            type="text" name="phone_number" :value="old('phone_number')" placeholder="Phone Number" />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2 text-sm text-red-400" />
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col-reverse md:flex-row justify-between items-center pt-6 mt-6 border-t border-gray-700/50">
            <!-- Login Link -->
            <a href="{{ route('login') }}" class="text-white hover:text-blue-400 text-sm font-medium underline underline-offset-4 transition-colors">
                {{ __('Already have an account? Log in') }}
            </a>

            <!-- Register Button -->
            <x-primary-button class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-lg font-medium text-white transition-colors">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
