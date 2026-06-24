<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Messages — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

{{--
    Full-screen chat layout.
    On desktop: sidebar (left) + main panel (right), both filling the viewport height.
    On mobile:  Alpine.js toggles between sidebar and main panel.
--}}
<div
    class="flex h-screen overflow-hidden"
    x-data="{ showSidebar: true }"
>
    {{-- ═══════════════════════════════ SIDEBAR ═══════════════════════════════ --}}
    <aside
        class="flex-shrink-0 w-full lg:w-80 bg-indigo-900 flex flex-col
               lg:flex lg:relative
               absolute inset-0 z-10"
        :class="showSidebar ? 'flex' : 'hidden lg:flex'"
    >
        @include('conversations.partials.sidebar', ['conversations' => $conversations])
    </aside>

    {{-- ═══════════════════════════════ EMPTY STATE ═══════════════════════════════ --}}
    <main
        class="flex-1 flex flex-col bg-gray-50"
        :class="showSidebar ? 'hidden lg:flex' : 'flex'"
    >
        {{-- Top bar (mobile: back button | desktop: nav bar) --}}
        <header class="flex items-center gap-3 px-6 py-4 bg-white border-b border-gray-200 shadow-sm">

            {{-- Mobile: back to sidebar --}}
            <button
                class="lg:hidden text-gray-400 hover:text-gray-600"
                @click="showSidebar = true"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <span class="font-semibold text-gray-800 text-sm">Messages</span>

            {{-- Desktop: utility links --}}
            <div class="hidden lg:flex items-center gap-4 ml-auto text-sm text-gray-500">
                <a href="{{ route('browse.index') }}" class="hover:text-indigo-600 transition-colors">Browse</a>
                <a href="{{ route('dating-profile.edit') }}" class="hover:text-indigo-600 transition-colors">My Profile</a>
                <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-red-500 transition-colors">Log out</button>
                </form>
            </div>
        </header>

        {{-- Empty state --}}
        <div class="flex-1 flex flex-col items-center justify-center text-gray-400">
            <div class="text-6xl mb-4">💬</div>
            <p class="text-lg font-medium text-gray-600">Your Messages</p>
            <p class="text-sm mt-1">
                Select a conversation from the sidebar, or
                <a href="{{ route('browse.index') }}" class="text-indigo-600 hover:underline">browse profiles</a>
                to start one.
            </p>
        </div>
    </main>
</div>

</body>
</html>
