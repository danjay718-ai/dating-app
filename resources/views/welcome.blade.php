<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @php
            $configuredName = config('app.name', 'Laravel');
            $appName = $configuredName === 'Laravel' ? 'Kindred' : $configuredName;
        @endphp

        <title>{{ $appName }}</title>

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <main class="min-h-screen bg-[#fff7f5] font-sans text-[#32142f]">
            <section class="relative isolate overflow-hidden bg-[#3f173f] px-6 pb-14 pt-6 text-white sm:px-10 lg:pb-20">
                <div class="absolute inset-0 -z-20 bg-[linear-gradient(135deg,#f97373_0%,#b83272_48%,#34143d_100%)]"></div>
                <svg class="absolute inset-0 -z-10 h-full w-full opacity-30" viewBox="0 0 1440 780" fill="none" preserveAspectRatio="none" aria-hidden="true">
                    <path d="M-110 570C96 460 246 478 420 570C625 678 812 642 998 508C1145 402 1280 392 1530 482" stroke="#fff7ed" stroke-width="70" stroke-linecap="round" opacity=".16"/>
                    <path d="M-80 190C160 292 334 264 512 154C700 38 920 58 1100 178C1226 262 1360 284 1520 238" stroke="#ffd1dc" stroke-width="42" stroke-linecap="round" opacity=".22"/>
                </svg>
                <div class="absolute inset-0 -z-10 bg-[linear-gradient(180deg,rgba(255,255,255,.08),rgba(54,18,63,.36))]"></div>

                <div class="mx-auto flex w-full max-w-6xl flex-col">
                    <header class="flex items-center justify-between">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-lg font-semibold tracking-normal">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white/18 ring-1 ring-white/35">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M19.5 12.6 12 20l-7.5-7.4a5 5 0 0 1 7.1-7.1l.4.4.4-.4a5 5 0 0 1 7.1 7.1Z"/>
                                </svg>
                            </span>
                            <span>{{ $appName }}</span>
                        </a>

                        @if (Route::has('login'))
                            <nav class="flex items-center gap-3" aria-label="Landing page navigation">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="rounded-full border border-white/35 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/12 focus:outline-none focus:ring-2 focus:ring-white/70">
                                        Browse
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="rounded-full border border-white/35 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/12 focus:outline-none focus:ring-2 focus:ring-white/70">
                                        Sign In
                                    </a>
                                @endauth
                            </nav>
                        @endif
                    </header>

                    <div class="grid flex-1 items-center gap-12 py-16 lg:grid-cols-[1.05fr_0.75fr] lg:py-20">
                        <div class="max-w-3xl text-center lg:text-left">
                            <p class="mb-5 inline-flex items-center gap-2 rounded-full bg-white/14 px-4 py-2 text-sm font-semibold text-white/88 ring-1 ring-white/22 backdrop-blur">
                                <svg class="h-4 w-4 text-[#ffd1dc]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 3l1.7 5.3L19 10l-5.3 1.7L12 17l-1.7-5.3L5 10l5.3-1.7L12 3Z"/>
                                </svg>
                                Intentional dating
                            </p>
                            <h1 class="text-5xl font-bold leading-tight tracking-normal text-white sm:text-6xl lg:text-7xl">
                                Find your person.
                            </h1>
                            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-white/86 sm:text-xl lg:mx-0">
                                A simple place to meet people with real profiles, thoughtful prompts, and conversations that start naturally.
                            </p>

                            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row lg:justify-start">
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex min-w-44 items-center justify-center gap-2 rounded-full bg-white px-6 py-3 text-base font-bold text-[#7c244f] shadow-xl shadow-[#3f173f]/25 transition hover:-translate-y-1 hover:bg-[#fff7f5] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#7c2d72]">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M12 5v14"/>
                                            <path d="M5 12h14"/>
                                        </svg>
                                        Get Started
                                    </a>
                                @endif
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}" class="inline-flex min-w-44 items-center justify-center gap-2 rounded-full border border-white/60 px-6 py-3 text-base font-bold text-white backdrop-blur transition hover:-translate-y-1 hover:bg-white/12 focus:outline-none focus:ring-2 focus:ring-white/80">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M15 8a3 3 0 1 0-6 0"/>
                                            <path d="M5 20a7 7 0 0 1 14 0"/>
                                        </svg>
                                        Sign In
                                    </a>
                                @endif
                            </div>

                            <p class="mt-8 text-sm font-medium text-white/68">Designed for thoughtful matches and better first conversations.</p>
                        </div>

                        <div class="mx-auto w-full max-w-sm lg:mr-0">
                            <x-landing.profile-card
                                image="images/landing/profile-1.png"
                                name="Alex"
                                meta="31, BGC"
                                prompt="Looking for someone who laughs easily and plans good weekend food."
                                tag="New here"
                                accent="rose"
                                active
                            />
                        </div>
                    </div>
                </div>
            </section>

            <section class="px-6 py-14 sm:px-10 lg:py-20" aria-labelledby="highlights-title">
                <div class="mx-auto max-w-6xl">
                    <div class="mb-10 max-w-2xl">
                        <div>
                            <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#be185d]">How it works</p>
                            <h2 id="highlights-title" class="mt-3 text-3xl font-bold tracking-normal text-[#32142f] sm:text-4xl">A calmer way to meet someone new.</h2>
                        </div>
                        <p class="mt-4 leading-7 text-[#6c4d65]">The landing page keeps the story focused: create a profile, browse people, and start a conversation.</p>
                    </div>
                    <div class="grid gap-8 md:grid-cols-3">
                        <x-landing.highlight-card
                            icon="user-heart"
                            title="Real profiles"
                            description="Share what matters and browse profiles shaped around personality, values, and everyday chemistry."
                        />
                        <x-landing.highlight-card
                            icon="sparkles"
                            title="Smart matching"
                            description="Warm prompts and thoughtful filters help surface people who feel closer to what you are looking for."
                        />
                        <x-landing.highlight-card
                            icon="messages"
                            title="Start a conversation"
                            description="Gentle conversation cues make it easier to say hello and turn a match into a real exchange."
                        />
                    </div>
                </div>
            </section>

            <footer class="border-t border-[#f2d7d5] bg-white px-6 py-8 sm:px-10">
                <div class="mx-auto grid max-w-6xl gap-6 text-sm text-[#6c4d65] sm:grid-cols-[1fr_auto] sm:items-center">
                    <div class="flex items-start gap-4">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#9f2d60] text-white">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M19.5 12.6 12 20l-7.5-7.4a5 5 0 0 1 7.1-7.1l.4.4.4-.4a5 5 0 0 1 7.1 7.1Z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="text-lg font-bold text-[#32142f]">{{ $appName }}</p>
                            <p class="mt-1 max-w-lg leading-6">A warmer way to meet someone who might become your favorite person.</p>
                        </div>
                    </div>
                    <nav class="flex flex-wrap items-center gap-5" aria-label="Footer navigation">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="font-bold transition hover:text-[#9f2d60]">Login</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-bold transition hover:text-[#9f2d60]">Register</a>
                        @endif
                    </nav>
                </div>
            </footer>
        </main>
    </body>
</html>
