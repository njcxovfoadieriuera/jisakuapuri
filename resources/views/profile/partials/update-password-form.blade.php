<section class="w-full">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 w-full">
        @csrf
        @method('put')

        <div class="flex justify-between">
            <x-input-label for="current_password" :value="__('Current Password')" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-6/12" autocomplete="current-password"/>
        </div> 

        <div class="flex justify-between">
            <x-input-label for="password" :value="__('New Password')" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-6/12" autocomplete="new-password" />
        </div>

        <div class="flex justify-between">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-6/12" autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-center gap-4 ">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
