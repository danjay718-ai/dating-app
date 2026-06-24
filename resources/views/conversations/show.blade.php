<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php $other = $conversation->participants->firstWhere('id', '!=', auth()->id()); @endphp
    <title>{{ $other?->name ?? 'Conversation' }} — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

<div
    class="flex h-screen overflow-hidden"
    x-data="{ showSidebar: false }"
>
    {{-- ═══════════════════════════════ SIDEBAR ═══════════════════════════════ --}}
    <aside
        class="flex-shrink-0 w-full lg:w-80 bg-indigo-900 flex flex-col
               lg:flex lg:relative
               absolute inset-0 z-10"
        :class="showSidebar ? 'flex' : 'hidden lg:flex'"
    >
        @include('conversations.partials.sidebar', [
            'conversations'      => $conversations,
            'activeConversation' => $conversation,
        ])
    </aside>

    {{-- ═══════════════════════════════ CHAT PANEL ═══════════════════════════════ --}}
    <main
        class="flex-1 flex flex-col bg-white min-w-0"
        :class="showSidebar ? 'hidden lg:flex' : 'flex'"
    >

        {{-- ── Chat Header ── --}}
        <header class="flex items-center gap-3 px-4 py-3 bg-white border-b border-gray-200 shadow-sm flex-shrink-0">

            {{-- Mobile: open sidebar --}}
            <button
                class="lg:hidden flex-shrink-0 text-gray-400 hover:text-indigo-600 transition-colors"
                @click="showSidebar = true"
                title="Back to conversations"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            {{-- Avatar --}}
            <div class="flex-shrink-0 w-9 h-9 rounded-full bg-gradient-to-br from-pink-400 to-indigo-500 flex items-center justify-center">
                <span class="text-white font-bold text-sm">
                    {{ strtoupper(substr($other?->name ?? '?', 0, 1)) }}
                </span>
            </div>

            {{-- Name & status --}}
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-gray-900 text-sm truncate">{{ $other?->name ?? 'Unknown' }}</p>
                @if ($other?->profile?->location)
                    <p class="text-xs text-gray-400 truncate">📍 {{ $other->profile->location }}</p>
                @endif
            </div>

            {{-- View profile link --}}
            @if ($other)
                <a
                    href="{{ route('browse.show', $other) }}"
                    class="flex-shrink-0 text-xs text-indigo-600 hover:text-indigo-800 font-medium transition-colors hidden sm:block"
                >
                    View profile
                </a>
            @endif
        </header>

        {{-- ── Messages Thread ── --}}
        <div
            id="messages-thread"
            class="flex-1 overflow-y-auto px-4 py-6 space-y-4 bg-gray-50"
        >
            @if ($conversation->messages->isEmpty())
                <div class="flex flex-col items-center justify-center h-full text-gray-400 text-sm">
                    <div class="text-4xl mb-3">👋</div>
                    <p>No messages yet. Say hello!</p>
                </div>
            @else
                @foreach ($conversation->messages as $message)
                    @php $isMine = $message->sender_id === auth()->id(); @endphp

                    <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }} items-end gap-2">

                        {{-- Their avatar (only for received messages) --}}
                        @unless ($isMine)
                            <div class="flex-shrink-0 w-7 h-7 rounded-full bg-gradient-to-br from-pink-400 to-indigo-500 flex items-center justify-center mb-1">
                                <span class="text-white font-bold text-xs">
                                    {{ strtoupper(substr($message->sender?->name ?? '?', 0, 1)) }}
                                </span>
                            </div>
                        @endunless

                        {{-- Bubble --}}
                        <div class="max-w-xs lg:max-w-md xl:max-w-lg">
                            <div class="px-4 py-2.5 rounded-2xl text-sm leading-relaxed break-words
                                {{ $isMine
                                    ? 'bg-indigo-600 text-white rounded-br-sm'
                                    : 'bg-white text-gray-800 rounded-bl-sm shadow-sm border border-gray-100' }}"
                            >
                                {{ $message->body }}
                            </div>
                            <p class="text-[11px] text-gray-400 mt-1 {{ $isMine ? 'text-right' : 'text-left ml-1' }}">
                                {{ $message->created_at->format('g:i A') }}
                            </p>
                        </div>

                        {{-- My avatar (only for sent messages) --}}
                        @if ($isMine)
                            <div class="flex-shrink-0 w-7 h-7 rounded-full bg-indigo-600 flex items-center justify-center mb-1">
                                <span class="text-white font-bold text-xs">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>

        {{-- ── Message Input ── --}}
        <div class="flex-shrink-0 px-4 py-3 bg-white border-t border-gray-200">

            @if ($errors->any())
                <p class="text-xs text-red-500 mb-2">{{ $errors->first('body') }}</p>
            @endif

            <form
                method="POST"
                action="{{ route('messages.store', $conversation) }}"
                class="flex items-end gap-2"
            >
                @csrf

                <textarea
                    id="message-input"
                    name="body"
                    rows="1"
                    placeholder="Type a message..."
                    maxlength="2000"
                    class="flex-1 resize-none bg-gray-100 border-0 rounded-2xl px-4 py-2.5 text-sm
                           focus:outline-none focus:ring-2 focus:ring-indigo-400 transition
                           leading-relaxed"
                    x-data
                    x-on:keydown.enter.prevent="if (!$event.shiftKey) $el.closest('form').submit()"
                ></textarea>

                <button
                    type="submit"
                    class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-600 hover:bg-indigo-700
                           flex items-center justify-center transition-colors duration-150 shadow-sm"
                    title="Send (Enter)"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0l-7 7m7-7l7 7" />
                    </svg>
                </button>
            </form>

            <p class="text-[10px] text-gray-400 mt-1.5 text-center">
                Enter to send &middot; Shift+Enter for new line
            </p>
        </div>
    </main>
</div>

{{-- Auto-scroll to bottom --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const thread = document.getElementById('messages-thread');
        if (thread) thread.scrollTop = thread.scrollHeight;
    });
</script>

</body>
</html>
