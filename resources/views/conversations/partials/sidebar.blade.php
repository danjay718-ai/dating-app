{{--
    Shared messages sidebar.
    Variables expected:
      $conversations      - Collection of conversations
      $activeConversation - optional current Conversation model
--}}
<aside class="flex h-full w-full flex-col rounded-[1.5rem] bg-white ring-1 ring-[#f2d7d5]">
    <div class="border-b border-[#f2d7d5] p-5">
        <div class="flex items-center justify-between gap-3">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.16em] text-[#be185d]">Messages</p>
                <h2 class="mt-2 text-2xl font-bold tracking-normal text-[#32142f]">Inbox</h2>
            </div>
            <a href="{{ route('browse.index') }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-[#9f2d60] text-white transition hover:bg-[#7c244f]" aria-label="Start new conversation">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 5v14"/>
                    <path d="M5 12h14"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto p-3">
        @forelse ($conversations as $conv)
            @php
                $other = $conv->participants->firstWhere('id', '!=', auth()->id());
                $latest = $conv->messages->first();
                $isActive = isset($activeConversation) && $activeConversation->id === $conv->id;
            @endphp

            <a
                href="{{ route('conversations.show', $conv) }}"
                class="mb-2 flex items-center gap-3 rounded-2xl p-3 transition {{ $isActive ? 'bg-[#fff1f4]' : 'hover:bg-[#fff7f5]' }}"
            >
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[linear-gradient(135deg,#fb7185,#7c2d72)] text-sm font-bold text-white">
                    {{ strtoupper(substr($other?->name ?? '?', 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-baseline justify-between gap-2">
                        <p class="truncate text-sm font-bold text-[#32142f]">{{ $other?->name ?? 'Unknown' }}</p>
                        @if ($latest)
                            <span class="shrink-0 text-[11px] font-semibold text-[#a18496]">{{ $latest->created_at->format('g:i A') }}</span>
                        @endif
                    </div>
                    <p class="mt-1 truncate text-xs leading-5 text-[#7a5a70]">
                        {{ $latest?->body ? Str::limit($latest->body, 42) : 'No messages yet.' }}
                    </p>
                </div>
            </a>
        @empty
            <div class="px-4 py-10 text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#fff1f4] text-[#9f2d60]">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M8 9h8"/>
                        <path d="M8 13h6"/>
                        <path d="M9 18H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3h-3l-3 3-3-3Z"/>
                    </svg>
                </div>
                <p class="mt-4 text-sm font-bold text-[#32142f]">No conversations yet</p>
                <a href="{{ route('browse.index') }}" class="mt-2 inline-block text-sm font-bold text-[#9f2d60]">Discover matches</a>
            </div>
        @endforelse
    </div>
</aside>
