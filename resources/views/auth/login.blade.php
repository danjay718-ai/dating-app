<x-guest-layout>
    <div class="mb-7 text-center">
        <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#be185d]">Welcome back</p>
        <h1 class="mt-3 text-3xl font-bold tracking-normal text-[#32142f]">Pick up where it felt real.</h1>
        <p class="mt-3 text-sm leading-6 text-[#6c4d65]">Sign in to browse profiles, reply to conversations, and keep the spark moving.</p>
    </div>

    <x-auth-session-status class="mb-4 rounded-2xl bg-[#fff1f4] p-3 text-sm font-medium text-[#9f2d60]" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-bold text-[#32142f]">{{ __('Email') }}</label>
            <input id="email" class="mt-2 block w-full rounded-2xl border-[#f0c8cf] bg-[#fffaf9] px-4 py-3 text-[#32142f] shadow-sm transition placeholder:text-[#b49aaa] focus:border-[#be185d] focus:ring-[#be185d]" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="you@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between gap-3">
                <label for="password" class="block text-sm font-bold text-[#32142f]">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a class="text-sm font-bold text-[#9f2d60] transition hover:text-[#7c244f]" href="{{ route('password.request') }}">
                        {{ __('Forgot?') }}
                    </a>
                @endif
            </div>
            <input id="password" class="mt-2 block w-full rounded-2xl border-[#f0c8cf] bg-[#fffaf9] px-4 py-3 text-[#32142f] shadow-sm transition placeholder:text-[#b49aaa] focus:border-[#be185d] focus:ring-[#be185d]" type="password" name="password" required autocomplete="current-password" placeholder="Your password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="flex items-center gap-3 rounded-2xl bg-[#fff7f5] px-4 py-3 text-sm font-medium text-[#6c4d65]">
            <input id="remember_me" type="checkbox" class="rounded border-[#e8bcc4] text-[#9f2d60] shadow-sm focus:ring-[#be185d]" name="remember">
            <span>{{ __('Remember me') }}</span>
        </label>

        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#9f2d60] px-6 py-3 text-base font-bold text-white shadow-lg shadow-[#9f2d60]/20 transition hover:-translate-y-0.5 hover:bg-[#7c244f] focus:outline-none focus:ring-2 focus:ring-[#be185d] focus:ring-offset-2">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M15 8a3 3 0 1 0-6 0"/>
                <path d="M5 20a7 7 0 0 1 14 0"/>
            </svg>
            {{ __('Sign In') }}
        </button>
    </form>

    @if (Route::has('register'))
        <p class="mt-6 text-center text-sm text-[#6c4d65]">
            New here?
            <a href="{{ route('register') }}" class="font-bold text-[#9f2d60] transition hover:text-[#7c244f]">Create an account</a>
        </p>
    @endif
</x-guest-layout>
