<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Error Flash --}}
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg text-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if ($conversations->isEmpty())
                <div class="text-center py-20 text-gray-400">
                    <p class="text-lg font-medium">No conversations yet.</p>
                    <p class="text-sm mt-1">
                        <a href="{{ route('browse.index') }}" class="text-indigo-600 hover:underline">Browse profiles</a>
                        and start a conversation!
                    </p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($conversations as $conversation)
                        @php
                            {{-- Find the other participant (not the current user) --}}
                            $other = $conversation->participants->firstWhere('id', '!=', auth()->id());
                            $latest = $conversation->messages->first();
                        @endphp

                        <a
                            href="{{ route('conversations.show', $conversation) }}"
                            class="flex items-center gap-4 bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md hover:border-indigo-200 transition-all duration-150"
                        >
                            {{-- Avatar --}}
                            <div class="flex-shrink-0 h-12 w-12 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                <span class="text-white text-lg font-bold">
                                    {{ strtoupper(substr($other?->name ?? '?', 0, 1)) }}
                                </span>
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-900 truncate">{{ $other?->name ?? 'Unknown' }}</p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ $latest?->body ? Str::limit($latest->body, 60) : 'No messages yet.' }}
                                </p>
                            </div>

                            {{-- Time --}}
                            @if ($latest)
                                <div class="flex-shrink-0 text-xs text-gray-400">
                                    {{ $latest->created_at->diffForHumans() }}
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
