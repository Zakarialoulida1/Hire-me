<x-guest-layout>

    <div class="wrapper">

        <div class="login-box">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <h2>Login</h2>

        <div class="input-box">
        <span class="icon">
         <i class="fa-solid fa-user"></i>
        </span>

            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <label>name</label>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address-->
        <div class="input-box">
        <span class="icon">
          <ion-icon name="mail"></ion-icon>
        </span>

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <label>Email</label>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->

        <div class="input-box">
        <span class="icon">
          <ion-icon name="lock-closed"></ion-icon>
        </span>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <label>Password</label>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->

        <div class="input-box">
        <span class="icon">
          <ion-icon name="lock-closed"></ion-icon>
        </span>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <label>Confirm Password</label>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="mt-4">
            <div class="mt-4">

                <input type="text" name="role" value="user" class="hidden">
            </div>
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
        </div></div>

</x-guest-layout>

