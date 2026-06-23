<x-app-layout>
    <x-slot name="header">
        @php
            $other = $conversation->participants->firstWhere('id', '!=', auth()->id());
        @endphp
        <div class="flex items-center gap-2">
            <a href="{{ route('conversations.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                &larr; Messages
            </a>
            <span class="text-gray-300">/</span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $other?->name ?? 'Conversation' }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden flex flex-col" style="height: 70vh;">

                {{-- Messages Thread --}}
                <div
                    id="messages-thread"
                    class="flex-1 overflow-y-auto p-6 space-y-4"
                >
                    @if ($conversation->messages->isEmpty())
                        <div class="text-center text-gray-400 text-sm py-10">
                            No messages yet. Say hello! 👋
                        </div>
                    @else
                        @foreach ($conversation->messages as $message)
                            @php
                                $isMine = $message->sender_id === auth()->id();
                            @endphp

                            <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-xs lg:max-w-md">

                                    {{-- Sender name (only for other user) --}}
                                    @unless ($isMine)
                                        <p class="text-xs text-gray-400 mb-1 ml-1">{{ $message->sender?->name }}</p>
                                    @endunless

                                    {{-- Bubble --}}
                                    <div class="px-4 py-2 rounded-2xl text-sm leading-relaxed
                                        {{ $isMine
                                            ? 'bg-indigo-600 text-white rounded-br-sm'
                                            : 'bg-gray-100 text-gray-800 rounded-bl-sm' }}
                                    ">
                                        {{ $message->body }}
                                    </div>

                                    {{-- Timestamp --}}
                                    <p class="text-xs text-gray-400 mt-1 {{ $isMine ? 'text-right mr-1' : 'ml-1' }}">
                                        {{ $message->created_at->format('g:i A') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                {{-- Message Input Form --}}
                <div class="border-t border-gray-100 p-4 bg-gray-50">

                    {{-- Validation error --}}
                    @if ($errors->any())
                        <p class="text-sm text-red-600 mb-2">{{ $errors->first('body') }}</p>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('messages.store', $conversation) }}"
                        class="flex items-end gap-3"
                    >
                        @csrf

                        <textarea
                            id="message-input"
                            name="body"
                            rows="1"
                            placeholder="Type a message..."
                            maxlength="2000"
                            class="flex-1 resize-none border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition"
                            x-data
                            x-on:keydown.enter.prevent="if (!$event.shiftKey) $el.closest('form').submit()"
                        ></textarea>

                        <button
                            type="submit"
                            class="flex-shrink-0 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors duration-150"
                        >
                            Send
                        </button>
                    </form>
                    <p class="text-xs text-gray-400 mt-1.5">Press Enter to send, Shift+Enter for new line</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Auto-scroll to bottom of messages on page load --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const thread = document.getElementById('messages-thread');
            if (thread) {
                thread.scrollTop = thread.scrollHeight;
            }
        });
    </script>
</x-app-layout>
