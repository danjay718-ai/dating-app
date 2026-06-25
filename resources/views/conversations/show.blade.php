<x-app-layout>
    @php
        $other = $conversation->participants->firstWhere('id', '!=', auth()->id());
    @endphp

    <div class="min-h-screen bg-[#fff7f5] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto grid h-[calc(100vh-3rem)] max-w-[1500px] gap-6 lg:grid-cols-[360px_1fr]">
            @include('conversations.partials.sidebar', [
                'conversations' => $conversations,
                'activeConversation' => $conversation,
            ])

            <main class="flex min-h-0 flex-col overflow-hidden rounded-[1.5rem] bg-white ring-1 ring-[#f2d7d5]">
                <header class="flex items-center gap-4 border-b border-[#f2d7d5] px-5 py-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[linear-gradient(135deg,#fb7185,#7c2d72)] text-sm font-bold text-white">
                        {{ strtoupper(substr($other?->name ?? '?', 0, 1)) }}
                    </div>

                    <div class="min-w-0 flex-1">
                        <h1 class="truncate text-lg font-bold tracking-normal text-[#32142f]">{{ $other?->name ?? 'Unknown' }}</h1>
                        @if ($other?->profile?->location)
                            <p class="mt-1 truncate text-sm font-medium text-[#8a6a7f]">{{ $other->profile->location }}</p>
                        @endif
                    </div>

                    @if ($other)
                        <a href="{{ route('browse.show', $other) }}" class="hidden rounded-full bg-[#fff7f5] px-4 py-2 text-sm font-bold text-[#7a5a70] ring-1 ring-[#f2d7d5] transition hover:text-[#9f2d60] sm:inline-flex">
                            View profile
                        </a>
                    @endif
                </header>

                <section id="messages-thread" class="flex-1 space-y-4 overflow-y-auto bg-[#fffaf9] px-5 py-6">
                    @if ($conversation->messages->isEmpty())
                        <div class="flex h-full flex-col items-center justify-center text-center">
                            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#fff1f4] text-[#9f2d60]">
                                <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M19.5 12.6 12 20l-7.5-7.4a5 5 0 0 1 7.1-7.1l.4.4.4-.4a5 5 0 0 1 7.1 7.1Z"/>
                                </svg>
                            </div>
                            <p class="mt-5 text-lg font-bold text-[#32142f]">No messages yet</p>
                            <p class="mt-2 max-w-sm text-sm leading-6 text-[#6c4d65]">Start with something simple and genuine.</p>
                        </div>
                    @else
                        @foreach ($conversation->messages as $message)
                            @php $isMine = $message->sender_id === auth()->id(); @endphp

                            <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }} items-end gap-2">
                                @unless ($isMine)
                                    <div class="mb-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[linear-gradient(135deg,#fb7185,#7c2d72)] text-xs font-bold text-white">
                                        {{ strtoupper(substr($message->sender?->name ?? '?', 0, 1)) }}
                                    </div>
                                @endunless

                                <div class="max-w-[78%] sm:max-w-md lg:max-w-xl">
                                    <div class="rounded-3xl px-4 py-3 text-sm leading-6 {{ $isMine ? 'rounded-br-md bg-[#9f2d60] text-white' : 'rounded-bl-md bg-white text-[#32142f] ring-1 ring-[#f2d7d5]' }}">
                                        {{ $message->body }}
                                    </div>
                                    <p class="mt-1 text-[11px] font-semibold text-[#a18496] {{ $isMine ? 'text-right' : 'ml-1 text-left' }}">
                                        {{ $message->created_at->format('g:i A') }}
                                    </p>
                                </div>

                                @if ($isMine)
                                    <div class="mb-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#32142f] text-xs font-bold text-white">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </section>

                <footer class="border-t border-[#f2d7d5] bg-white px-5 py-4">
                    @if ($errors->any())
                        <p class="mb-2 text-xs font-semibold text-red-500">{{ $errors->first('body') }}</p>
                    @endif

                    <form method="POST" action="{{ route('messages.store', $conversation) }}" class="flex items-end gap-3">
                        @csrf
                        <textarea
                            id="message-input"
                            name="body"
                            rows="1"
                            placeholder="Write a message..."
                            maxlength="2000"
                            class="min-h-11 flex-1 resize-none rounded-3xl border-0 bg-[#fff7f5] px-4 py-3 text-sm leading-6 text-[#32142f] ring-1 ring-[#f2d7d5] placeholder:text-[#a78b9d] focus:ring-2 focus:ring-[#be185d]"
                            x-data
                            x-on:keydown.enter.prevent="if (!$event.shiftKey) $el.closest('form').submit()"
                        ></textarea>

                        <button type="submit" class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#9f2d60] text-white transition hover:bg-[#7c244f]" aria-label="Send message">
                            <svg class="h-5 w-5 rotate-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 19V5"/>
                                <path d="m5 12 7-7 7 7"/>
                            </svg>
                        </button>
                    </form>
                </footer>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const thread = document.getElementById('messages-thread');
            if (thread) thread.scrollTop = thread.scrollHeight;
        });
    </script>
</x-app-layout>
