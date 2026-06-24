<x-guest-layout>
    <div class="mb-7 text-center">
        <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#be185d]">Join Kindred</p>
        <h1 class="mt-3 text-3xl font-bold tracking-normal text-[#32142f]">Start with a real hello.</h1>
        <p class="mt-3 text-sm leading-6 text-[#6c4d65]">Create your account and begin building a profile that feels like you.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-bold text-[#32142f]">{{ __('Name') }}</label>
            <input id="name" class="mt-2 block w-full rounded-2xl border-[#f0c8cf] bg-[#fffaf9] px-4 py-3 text-[#32142f] shadow-sm transition placeholder:text-[#b49aaa] focus:border-[#be185d] focus:ring-[#be185d]" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Your name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="block text-sm font-bold text-[#32142f]">{{ __('Email') }}</label>
            <input id="email" class="mt-2 block w-full rounded-2xl border-[#f0c8cf] bg-[#fffaf9] px-4 py-3 text-[#32142f] shadow-sm transition placeholder:text-[#b49aaa] focus:border-[#be185d] focus:ring-[#be185d]" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="you@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-bold text-[#32142f]">{{ __('Password') }}</label>
            <input id="password" class="mt-2 block w-full rounded-2xl border-[#f0c8cf] bg-[#fffaf9] px-4 py-3 text-[#32142f] shadow-sm transition placeholder:text-[#b49aaa] focus:border-[#be185d] focus:ring-[#be185d]" type="password" name="password" required autocomplete="new-password" placeholder="Create a password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-bold text-[#32142f]">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="mt-2 block w-full rounded-2xl border-[#f0c8cf] bg-[#fffaf9] px-4 py-3 text-[#32142f] shadow-sm transition placeholder:text-[#b49aaa] focus:border-[#be185d] focus:ring-[#be185d]" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat your password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#9f2d60] px-6 py-3 text-base font-bold text-white shadow-lg shadow-[#9f2d60]/20 transition hover:-translate-y-0.5 hover:bg-[#7c244f] focus:outline-none focus:ring-2 focus:ring-[#be185d] focus:ring-offset-2">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 5v14"/>
                <path d="M5 12h14"/>
            </svg>
            {{ __('Create Account') }}
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-[#6c4d65]">
        Already registered?
        <a href="{{ route('login') }}" class="font-bold text-[#9f2d60] transition hover:text-[#7c244f]">Sign in</a>
    </p>
</x-guest-layout>
