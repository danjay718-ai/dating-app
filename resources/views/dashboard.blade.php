<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome Banner --}}
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl p-8 text-white shadow-sm">
                <h1 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}! 👋</h1>
                <p class="mt-1 text-indigo-100 text-sm">Here's what's happening with your account.</p>
            </div>

            {{-- Profile Completion Notice --}}
            @if (! auth()->user()->profile)
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5 flex items-start gap-4">
                    <span class="text-2xl">⚠️</span>
                    <div>
                        <p class="font-semibold text-yellow-800">Your dating profile is incomplete.</p>
                        <p class="text-sm text-yellow-700 mt-0.5">Other users can't find you until you set up your profile.</p>
                        <a href="{{ route('dating-profile.edit') }}" class="mt-2 inline-block text-sm font-medium text-yellow-800 underline hover:text-yellow-900">
                            Set up your profile →
                        </a>
                    </div>
                </div>
            @endif

            {{-- Quick Actions --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('browse.index') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md hover:border-indigo-200 transition-all duration-150 group">
                    <div class="text-3xl mb-3">🔍</div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-indigo-600">Browse Profiles</h3>
                    <p class="text-sm text-gray-500 mt-1">Discover people near you.</p>
                </a>

                <a href="{{ route('conversations.index') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md hover:border-indigo-200 transition-all duration-150 group">
                    <div class="text-3xl mb-3">💬</div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-indigo-600">Messages</h3>
                    <p class="text-sm text-gray-500 mt-1">Check your conversations.</p>
                </a>

                <a href="{{ route('dating-profile.edit') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md hover:border-indigo-200 transition-all duration-150 group">
                    <div class="text-3xl mb-3">✏️</div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-indigo-600">Edit Profile</h3>
                    <p class="text-sm text-gray-500 mt-1">Update your bio and details.</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
