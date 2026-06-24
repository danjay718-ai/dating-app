<nav
    x-data="{ mobileOpen: false, userOpen: false }"
    class="bg-white border-b border-gray-200 sticky top-0 z-50"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14">

            {{-- ── Logo ── --}}
            <a href="{{ route('browse.index') }}" class="flex items-center gap-2 font-bold text-indigo-600 text-lg tracking-tight">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                {{ config('app.name', 'DateApp') }}
            </a>

            {{-- ── Desktop Nav Links ── --}}
            <div class="hidden sm:flex items-center gap-1">
                <a
                    href="{{ route('browse.index') }}"
                    class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                        {{ request()->routeIs('browse.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Browse
                </a>

                <a
                    href="{{ route('conversations.index') }}"
                    class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                        {{ request()->routeIs('conversations.*', 'messages.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Messages
                </a>
            </div>

            {{-- ── User Dropdown ── --}}
            <div class="hidden sm:flex items-center">
                <div class="relative" @click.outside="userOpen = false">
                    <button
                        @click="userOpen = !userOpen"
                        class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-full hover:bg-gray-100 transition-colors text-sm font-medium text-gray-700"
                    >
                        {{-- Avatar initial --}}
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="max-w-[120px] truncate">{{ auth()->user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400 transition-transform" :class="userOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown menu --}}
                    <div
                        x-show="userOpen"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50"
                        style="display:none"
                    >
                        <a href="{{ route('dating-profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Profile
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Account Settings
                        </a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ── Mobile Hamburger ── --}}
            <button
                class="sm:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors"
                @click="mobileOpen = !mobileOpen"
            >
                <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- ── Mobile Menu ── --}}
    <div
        x-show="mobileOpen"
        x-transition
        class="sm:hidden border-t border-gray-100 bg-white px-4 py-3 space-y-1"
        style="display:none"
    >
        <a href="{{ route('browse.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('browse.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            Browse
        </a>
        <a href="{{ route('conversations.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('conversations.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
            Messages
        </a>
        <a href="{{ route('dating-profile.edit') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('dating-profile.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            My Profile
        </a>
        <div class="border-t border-gray-100 pt-2 mt-1">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-gray-600 hover:bg-gray-50">Account Settings</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-red-600 hover:bg-red-50">Log Out</button>
            </form>
        </div>
    </div>
</nav>
