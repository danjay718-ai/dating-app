<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php
            $configuredName = config('app.name', 'Laravel');
            $appName = $configuredName === 'Laravel' ? 'Kindred' : $configuredName;
        @endphp

        <title>{{ $appName }}</title>

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-[#32142f] antialiased">
        <main class="relative isolate flex min-h-screen items-center justify-center overflow-hidden bg-[#fff7f5] px-6 py-10">
            <div class="absolute inset-0 -z-20 bg-[radial-gradient(circle_at_20%_18%,rgba(255,209,220,.8),transparent_24%),radial-gradient(circle_at_82%_12%,rgba(251,146,60,.34),transparent_22%),linear-gradient(135deg,#fff7f5_0%,#fff1f0_42%,#f7e9ff_100%)]"></div>
            <svg class="absolute inset-0 -z-10 h-full w-full opacity-55" viewBox="0 0 1440 900" fill="none" preserveAspectRatio="none" aria-hidden="true">
                <path d="M-90 660C138 520 298 552 458 642C642 745 810 710 996 575C1138 472 1280 450 1530 546" stroke="#ffd1dc" stroke-width="70" stroke-linecap="round" opacity=".26"/>
                <path d="M-70 214C150 312 322 292 502 170C692 42 904 62 1080 186C1218 284 1355 308 1514 254" stroke="#ffb4a2" stroke-width="44" stroke-linecap="round" opacity=".22"/>
            </svg>

            <section class="w-full max-w-md">
                <div class="mb-8 text-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-lg font-bold tracking-normal text-[#32142f]">
                        <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#9f2d60] text-white shadow-lg shadow-[#9f2d60]/20">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M19.5 12.6 12 20l-7.5-7.4a5 5 0 0 1 7.1-7.1l.4.4.4-.4a5 5 0 0 1 7.1 7.1Z"/>
                            </svg>
                        </span>
                        <span>{{ $appName }}</span>
                    </a>
                </div>

                <div class="overflow-hidden rounded-[1.5rem] border border-[#f4d7d5] bg-white/92 p-6 shadow-2xl shadow-[#7c2d72]/12 backdrop-blur sm:p-8">
                    {{ $slot }}
                </div>

                <p class="mt-6 text-center text-sm leading-6 text-[#7a5a70]">
                    A softer place to start something real.
                </p>
            </section>
        </main>
    </body>
</html>
