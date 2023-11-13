<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="" target="_blank">
            <img src="{{ asset('images/banco.png') }}" style="width: 200px;"  alt="">
            </a>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="identificacion" value="{{ __('identificacion') }}" />
                <x-input id="identificacion" class="block mt-1 w-full" type="text" name="identificacion"  required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label  for="password" value="{{ __('Password (Solo numeros)') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" pattern="[0-9]*" maxlength="4" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
