{{--
    Shared chat sidebar partial.
    Variables expected:
      $conversations      - Collection of conversations for the sidebar
      $activeConversation - (optional) currently open Conversation model
--}}
<div class="flex flex-col h-full">

    {{-- Sidebar Header --}}
    <div class="flex items-center justify-between px-4 py-4 border-b border-white/10">
        <div>
            <p class="text-xs text-indigo-300 font-medium tracking-widest uppercase">Messages</p>
            <p class="text-white font-semibold text-sm mt-0.5 truncate max-w-[160px]">{{ auth()->user()->name }}</p>
        </div>
        <a
            href="{{ route('browse.index') }}"
            title="Start new conversation"
            class="flex items-center justify-center w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 transition-colors"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
        </a>
    </div>

    {{-- Conversation List --}}
    <div class="flex-1 overflow-y-auto py-2">
        @forelse ($conversations as $conv)
            @php
                $other  = $conv->participants->firstWhere('id', '!=', auth()->id());
                $latest = $conv->messages->first();
                $isActive = isset($activeConversation) && $activeConversation->id === $conv->id;
            @endphp

            <a
                href="{{ route('conversations.show', $conv) }}"
                class="flex items-center gap-3 px-4 py-3 transition-colors duration-100
                    {{ $isActive ? 'bg-white/20' : 'hover:bg-white/10' }}"
            >
                {{-- Avatar --}}
                <div class="relative flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-400 to-indigo-500 flex items-center justify-center">
                        <span class="text-white font-bold text-sm">
                            {{ strtoupper(substr($other?->name ?? '?', 0, 1)) }}
                        </span>
                    </div>
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-baseline">
                        <p class="text-sm font-semibold text-white truncate">{{ $other?->name ?? 'Unknown' }}</p>
                        @if ($latest)
                            <span class="text-[10px] text-indigo-300 flex-shrink-0 ml-1">
                                {{ $latest->created_at->format('g:i A') }}
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-indigo-200 truncate mt-0.5">
                        {{ $latest?->body ? Str::limit($latest->body, 35) : 'No messages yet.' }}
                    </p>
                </div>
            </a>
        @empty
            <div class="px-4 py-8 text-center text-indigo-300 text-xs">
                No conversations yet.<br>
                <a href="{{ route('browse.index') }}" class="underline hover:text-white mt-1 inline-block">Browse profiles</a>
            </div>
        @endforelse
    </div>

    {{-- Sidebar Footer — account link --}}
    <div class="border-t border-white/10 px-4 py-3">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-indigo-300 hover:text-white text-xs transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>
    </div>
</div>
