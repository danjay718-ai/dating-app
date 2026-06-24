<x-app-layout>
    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 mb-6 text-sm">
                <a href="{{ route('browse.index') }}" class="text-gray-400 hover:text-indigo-600 transition-colors">← Browse</a>
                <span class="text-gray-300">/</span>
                <span class="text-gray-700 font-medium">{{ $user->name }}</span>
            </div>

            <div class="bg-white shadow-sm rounded-xl overflow-hidden">

                {{-- Hero / Avatar banner --}}
                <div class="h-40 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                    <span class="text-white text-6xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>
                </div>

                <div class="p-8">
                    {{-- Name & meta --}}
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>

                        <div class="flex flex-wrap gap-3 mt-2">
                            @if ($user->profile?->age)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-50 text-indigo-700">
                                    {{ $user->profile->age }} years old
                                </span>
                            @endif
                            @if ($user->profile?->gender)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-50 text-purple-700">
                                    {{ ucfirst($user->profile->gender) }}
                                </span>
                            @endif
                            @if ($user->profile?->location)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                                    📍 {{ $user->profile->location }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Bio --}}
                    @if ($user->profile?->bio)
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">About</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $user->profile->bio }}</p>
                        </div>
                    @endif

                    {{-- Looking for --}}
                    @if ($user->profile?->looking_for_gender)
                        <div class="mb-8">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Looking for</h3>
                            <p class="text-gray-700">{{ ucfirst($user->profile->looking_for_gender) }}</p>
                        </div>
                    @endif

                    {{-- Start Conversation Button --}}
                    <form method="POST" action="{{ route('conversations.store', $user) }}">
                        @csrf
                        <button
                            type="submit"
                            class="w-full py-3 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-colors duration-150"
                        >
                            💬 Send a Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
