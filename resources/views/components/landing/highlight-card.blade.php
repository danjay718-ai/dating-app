@props([
    'icon',
    'title',
    'description',
])

<article {{ $attributes->merge(['class' => 'group border-t border-[#f1d8d8] pt-6']) }}>
    <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-[#9f2d60] ring-1 ring-[#f1d8d8] transition group-hover:-translate-y-0.5 group-hover:ring-[#e9aebc]">
        @switch($icon)
            @case('user-heart')
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M8 7a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z"/>
                    <path d="M6 21v-2a4 4 0 0 1 4-4h1.5"/>
                    <path d="M18 22l3.35-3.28a2.1 2.1 0 0 0-2.95-2.98l-.4.39-.4-.39a2.1 2.1 0 0 0-2.95 2.98L18 22Z"/>
                </svg>
                @break

            @case('sparkles')
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 3l1.7 5.3L19 10l-5.3 1.7L12 17l-1.7-5.3L5 10l5.3-1.7L12 3Z"/>
                    <path d="M19 16l.8 2.2L22 19l-2.2.8L19 22l-.8-2.2L16 19l2.2-.8L19 16Z"/>
                    <path d="M5 3l.7 2.3L8 6l-2.3.7L5 9l-.7-2.3L2 6l2.3-.7L5 3Z"/>
                </svg>
                @break

            @case('messages')
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M8 9h8"/>
                    <path d="M8 13h6"/>
                    <path d="M9 18H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3h-3l-3 3-3-3Z"/>
                </svg>
                @break
        @endswitch
    </div>
    <h3 class="text-lg font-bold tracking-normal text-[#32142f]">{{ $title }}</h3>
    <p class="mt-3 leading-7 text-[#6c4d65]">{{ $description }}</p>
</article>
