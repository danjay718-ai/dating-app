<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Browse Profiles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- No profiles state --}}
            @if ($profiles->isEmpty())
                <div class="text-center py-20 text-gray-400">
                    <p class="text-lg font-medium">No profiles found yet.</p>
                    <p class="text-sm mt-1">Check back later!</p>
                </div>
            @else
                {{-- Profile Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($profiles as $user)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-200">

                            {{-- Avatar placeholder --}}
                            <div class="h-36 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                <span class="text-white text-4xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>

                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 text-base truncate">{{ $user->name }}</h3>

                                <div class="flex items-center gap-2 mt-1 text-sm text-gray-500">
                                    @if ($user->profile?->age)
                                        <span>{{ $user->profile->age }} yrs</span>
                                    @endif
                                    @if ($user->profile?->location)
                                        <span class="text-gray-300">•</span>
                                        <span class="truncate">{{ $user->profile->location }}</span>
                                    @endif
                                </div>

                                @if ($user->profile?->bio)
                                    <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                                        {{ $user->profile->bio }}
                                    </p>
                                @endif

                                <a
                                    href="{{ route('browse.show', $user) }}"
                                    class="mt-4 block text-center text-sm font-medium bg-indigo-50 text-indigo-700 hover:bg-indigo-100 rounded-lg py-2 transition-colors duration-150"
                                >
                                    View Profile
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $profiles->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
