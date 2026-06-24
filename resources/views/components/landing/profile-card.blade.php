@props([
    'image',
    'name',
    'meta',
    'prompt',
    'tag',
    'accent' => 'rose',
    'active' => false,
])

@php
    $accentClasses = [
        'rose' => 'from-[#fb7185] to-[#be185d] text-[#be185d] bg-[#fff1f4]',
        'purple' => 'from-[#a855f7] to-[#6d28d9] text-[#7c2d72] bg-[#f6f0ff]',
        'coral' => 'from-[#fb923c] to-[#ef4444] text-[#c2410c] bg-[#fff3ed]',
    ][$accent] ?? 'from-[#fb7185] to-[#be185d] text-[#be185d] bg-[#fff1f4]';
@endphp

<article {{ $attributes->merge(['class' => 'group overflow-hidden rounded-[1.25rem] bg-white shadow-xl shadow-[#32142f]/16 ring-1 ring-white/70 transition duration-300 hover:-translate-y-1']) }}>
    <div class="relative aspect-[4/5] overflow-hidden">
        <img src="{{ asset($image) }}" alt="{{ $name }} sample profile photo" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" @unless($active) loading="lazy" @endunless>
        <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(28,10,35,0)_35%,rgba(28,10,35,.86)_100%)]"></div>
        <div class="absolute left-4 top-4 rounded-full bg-white/88 px-3 py-1 text-xs font-bold text-[#7c244f] shadow-sm backdrop-blur">
            {{ $tag }}
        </div>
        <div class="absolute bottom-0 left-0 right-0 p-5 text-white">
            <div class="flex items-end justify-between gap-3">
                <div>
                    <h3 class="text-2xl font-bold tracking-normal">{{ $name }}</h3>
                    <p class="mt-1 text-sm font-medium text-white/78">{{ $meta }}</p>
                </div>
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-white text-[#be185d] shadow-lg">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19.5 12.6 12 20l-7.5-7.4a5 5 0 0 1 7.1-7.1l.4.4.4-.4a5 5 0 0 1 7.1 7.1Z"/>
                    </svg>
                </span>
            </div>
        </div>
    </div>
    <div class="space-y-4 p-5">
        <p class="text-sm leading-6 text-[#6c4d65]">{{ $prompt }}</p>
        <div class="flex items-center justify-between border-t border-[#f4d7d5] pt-4">
            <span class="rounded-full px-3 py-1 text-xs font-bold {{ $accentClasses }}">
                92% match
            </span>
            <span class="text-xs font-semibold text-[#8a6a7f]">Sample profile</span>
        </div>
    </div>
</article>
