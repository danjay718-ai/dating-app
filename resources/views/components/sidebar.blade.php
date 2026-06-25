@php
    $navItems = [
        [
            'label' => 'Discover',
            'route' => route('browse.index'),
            'active' => request()->routeIs('browse.*'),
            'icon' => 'heart',
        ],
        [
            'label' => 'Messages',
            'route' => route('conversations.index'),
            'active' => request()->routeIs('conversations.*', 'messages.*'),
            'icon' => 'message',
        ],
        [
            'label' => 'Profile',
            'route' => route('dating-profile.edit'),
            'active' => request()->routeIs('dating-profile.*', 'profile.*'),
            'icon' => 'profile',
        ],
    ];
@endphp

<aside class="fixed inset-y-0 left-0 z-40 flex w-20 flex-col items-center bg-white/92 px-2 py-5 sm:w-24">
    <a href="{{ route('browse.index') }}" class="mb-8 flex h-11 w-11 items-center justify-center rounded-2xl bg-[#9f2d60] text-white">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M19.5 12.6 12 20l-7.5-7.4a5 5 0 0 1 7.1-7.1l.4.4.4-.4a5 5 0 0 1 7.1 7.1Z"/>
        </svg>
    </a>

    <nav class="flex flex-1 flex-col items-center gap-3" aria-label="Primary navigation">
        @foreach ($navItems as $item)
            <a
                href="{{ $item['route'] }}"
                class="group flex w-full flex-col items-center gap-1 rounded-2xl px-2 py-3 text-[11px] font-bold transition {{ $item['active'] ? 'bg-[#fff1f4] text-[#9f2d60]' : 'text-[#8a6a7f] hover:bg-[#fff7f5] hover:text-[#9f2d60]' }}"
            >
                @switch($item['icon'])
                    @case('heart')
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M19.5 12.6 12 20l-7.5-7.4a5 5 0 0 1 7.1-7.1l.4.4.4-.4a5 5 0 0 1 7.1 7.1Z"/>
                        </svg>
                        @break

                    @case('message')
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M8 9h8"/>
                            <path d="M8 13h6"/>
                            <path d="M9 18H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3h-3l-3 3-3-3Z"/>
                        </svg>
                        @break

                    @case('profile')
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M8 7a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z"/>
                            <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>
                        </svg>
                        @break
                @endswitch
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <form method="POST" action="{{ route('logout') }}" class="mt-6">
        @csrf
        <button type="submit" class="flex h-10 w-10 items-center justify-center rounded-2xl text-[#8a6a7f] transition hover:bg-[#fff1f4] hover:text-[#9f2d60]" aria-label="Log out">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M10 17l5-5-5-5"/>
                <path d="M15 12H3"/>
                <path d="M21 19V5"/>
            </svg>
        </button>
    </form>
</aside>
