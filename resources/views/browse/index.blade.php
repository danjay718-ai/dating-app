<x-app-layout>
    <div class="min-h-screen bg-[#fff7f5] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-[1500px]">
            <section class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
                <div>
                    <h1 class="text-4xl font-bold tracking-normal text-[#32142f]">Discover</h1>
                    <p class="mt-2 text-[#7a5a70]">Find your match nearby.</p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <a href="{{ route('dating-profile.edit') }}" class="flex h-11 w-11 items-center justify-center rounded-full bg-[#9f2d60] text-sm font-bold text-white" aria-label="Profile">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </a>
                </div>
            </section>

            <section class="mt-8">
                <div class="mb-4 flex items-center justify-between gap-4">
                    <h2 class="text-lg font-bold tracking-normal text-[#32142f]">Recent matches</h2>
                    <a href="{{ route('conversations.index') }}" class="text-sm font-bold text-[#9f2d60] transition hover:text-[#7c244f]">Messages</a>
                </div>

                <div class="flex gap-4 overflow-x-auto pb-2">
                    @forelse ($recentMatches as $match)
                        <a href="{{ route('browse.show', $match) }}" class="w-20 shrink-0 text-center">
                            <span class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[linear-gradient(135deg,#fb7185,#7c2d72)] text-xl font-bold text-white ring-4 ring-white">
                                {{ strtoupper(substr($match->name, 0, 1)) }}
                            </span>
                            <span class="mt-2 block truncate text-xs font-bold text-[#6c4d65]">{{ $match->name }}</span>
                        </a>
                    @empty
                        <div class="rounded-2xl bg-white px-5 py-4 text-sm text-[#7a5a70] ring-1 ring-[#f2d7d5]">
                            No conversations yet.
                        </div>
                    @endforelse
                </div>
            </section>

            @if ($profiles->isEmpty())
                <section class="mt-8 rounded-[1.5rem] border border-[#f4d7d5] bg-white px-6 py-14 text-center">
                    <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-[#fff1f0] text-[#9f2d60]">
                        <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 21s-7-4.4-9.2-8.6A5.4 5.4 0 0 1 12 6.7a5.4 5.4 0 0 1 9.2 5.7C19 16.6 12 21 12 21Z"/>
                            <path d="M8.5 11.5h.01"/>
                            <path d="M15.5 11.5h.01"/>
                            <path d="M9 15c1.8 1.2 4.2 1.2 6 0"/>
                        </svg>
                    </div>
                    <h2 class="mt-6 text-2xl font-bold tracking-normal text-[#32142f]">No matches nearby yet — check back soon 💛</h2>
                    <p class="mx-auto mt-3 max-w-md leading-7 text-[#6c4d65]">
                        New people join over time. Keep your profile updated so the right matches can find you.
                    </p>
                    <a href="{{ route('dating-profile.edit') }}" class="mt-7 inline-flex items-center justify-center rounded-full bg-[#9f2d60] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#7c244f]">
                        Update my profile
                    </a>
                </section>
            @else
                <div class="mt-8">
                    <section class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
                        @foreach ($profiles as $user)
                            @php
                                $profile = $user->profile;
                                $initial = strtoupper(substr($user->name, 0, 1));
                            @endphp

                            <article class="group overflow-hidden rounded-[1.25rem] bg-white ring-1 ring-[#f2d7d5] transition duration-300 hover:-translate-y-1">
                                <a href="{{ route('browse.show', $user) }}" class="block">
                                    <div class="relative aspect-[4/3] overflow-hidden bg-[linear-gradient(135deg,#fb7185_0%,#b83272_54%,#34143d_100%)]">
                                        <div class="absolute inset-0 opacity-25">
                                            <svg class="h-full w-full" viewBox="0 0 420 520" fill="none" preserveAspectRatio="none" aria-hidden="true">
                                                <path d="M-40 386C45 318 108 330 178 384C260 447 322 421 462 330" stroke="#fff7ed" stroke-width="38" stroke-linecap="round"/>
                                                <path d="M-20 136C82 188 148 170 226 114C312 52 366 62 458 118" stroke="#ffd1dc" stroke-width="26" stroke-linecap="round"/>
                                            </svg>
                                        </div>
                                        <div class="flex h-full items-center justify-center">
                                            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-white/18 text-4xl font-bold text-white ring-1 ring-white/35 backdrop-blur">
                                                {{ $initial }}
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <div class="space-y-3 p-4">
                                    <div>
                                        <div class="flex items-center justify-between gap-3">
                                            <h2 class="truncate text-lg font-bold tracking-normal text-[#32142f]">{{ $user->name }}</h2>
                                            @if ($profile?->age)
                                                <span class="rounded-full bg-[#fff1f4] px-2.5 py-1 text-xs font-bold text-[#be185d]">{{ $profile->age }}</span>
                                            @endif
                                        </div>
                                        @if ($profile?->location)
                                            <p class="mt-1 text-sm font-medium text-[#8a6a7f]">{{ $profile->location }}</p>
                                        @endif
                                    </div>

                                    @if ($profile?->bio)
                                        <p class="min-h-[3rem] text-sm leading-6 text-[#6c4d65]">{{ \Illuminate\Support\Str::limit($profile->bio, 72) }}</p>
                                    @endif

                                    @if ($profile?->looking_for_gender)
                                        <span class="inline-flex rounded-full bg-[#fff1f4] px-3 py-1 text-xs font-bold text-[#be185d] ring-1 ring-[#f4d7d5]">
                                            Looking for: {{ ucfirst($profile->looking_for_gender) }}
                                        </span>
                                    @endif

                                    <form method="POST" action="{{ route('conversations.store', $user) }}" class="border-t border-[#f2d7d5] pt-3">
                                        @csrf
                                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#9f2d60] px-4 py-2.5 text-sm font-bold text-white transition hover:bg-[#7c244f] focus:outline-none focus:ring-2 focus:ring-[#be185d] focus:ring-offset-2">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M8 9h8"/>
                                                <path d="M8 13h6"/>
                                                <path d="M9 18H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3h-3l-3 3-3-3Z"/>
                                            </svg>
                                            Message
                                        </button>
                                    </form>
                                </div>
                            </article>
                        @endforeach
                    </section>

                    <div class="mt-8">
                        {{ $profiles->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
