<x-app-layout>
    <div class="min-h-screen bg-[#fff7f5] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto grid h-[calc(100vh-3rem)] max-w-[1500px] gap-6 lg:grid-cols-[360px_1fr]">
            @include('conversations.partials.sidebar', ['conversations' => $conversations])

            <main class="flex min-h-0 flex-col rounded-[1.5rem] bg-white ring-1 ring-[#f2d7d5]">
                <div class="flex flex-1 flex-col items-center justify-center px-6 text-center">
                    <div class="flex h-24 w-24 items-center justify-center rounded-full bg-[#fff1f4] text-[#9f2d60]">
                        <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M8 9h8"/>
                            <path d="M8 13h6"/>
                            <path d="M9 18H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3h-3l-3 3-3-3Z"/>
                        </svg>
                    </div>
                    <h1 class="mt-6 text-3xl font-bold tracking-normal text-[#32142f]">Your conversations</h1>
                    <p class="mt-3 max-w-md leading-7 text-[#6c4d65]">
                        Choose a conversation from the inbox, or discover someone new and start with a simple hello.
                    </p>
                    <a href="{{ route('browse.index') }}" class="mt-7 inline-flex items-center justify-center rounded-full bg-[#9f2d60] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#7c244f]">
                        Discover matches
                    </a>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
