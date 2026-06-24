<x-app-layout>
    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Flash Message --}}
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg p-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Profile Information</h3>
                <p class="text-sm text-gray-500 mb-6">This is what other users will see when they browse profiles.</p>

                <form method="POST" action="{{ route('dating-profile.update') }}">
                    @csrf
                    @method('PUT')

                    {{-- Age --}}
                    <div class="mb-5">
                        <x-input-label for="age" :value="__('Age')" />
                        <x-text-input
                            id="age"
                            name="age"
                            type="number"
                            class="mt-1 block w-full"
                            :value="old('age', $user->profile?->age)"
                            min="18"
                            max="100"
                            required
                        />
                        <x-input-error :messages="$errors->get('age')" class="mt-2" />
                    </div>

                    {{-- Bio --}}
                    <div class="mb-5">
                        <x-input-label for="bio" :value="__('Bio')" />
                        <textarea
                            id="bio"
                            name="bio"
                            rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            placeholder="Tell others a bit about yourself..."
                            maxlength="500"
                        >{{ old('bio', $user->profile?->bio) }}</textarea>
                        <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                    </div>

                    {{-- Gender --}}
                    <div class="mb-5">
                        <x-input-label for="gender" :value="__('I am')" />
                        <select
                            id="gender"
                            name="gender"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                        >
                            <option value="">-- Select --</option>
                            <option value="male"       {{ old('gender', $user->profile?->gender) === 'male'       ? 'selected' : '' }}>Male</option>
                            <option value="female"     {{ old('gender', $user->profile?->gender) === 'female'     ? 'selected' : '' }}>Female</option>
                            <option value="non-binary" {{ old('gender', $user->profile?->gender) === 'non-binary' ? 'selected' : '' }}>Non-binary</option>
                        </select>
                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                    </div>

                    {{-- Looking For --}}
                    <div class="mb-5">
                        <x-input-label for="looking_for_gender" :value="__('Looking for')" />
                        <select
                            id="looking_for_gender"
                            name="looking_for_gender"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                        >
                            <option value="">-- Select --</option>
                            <option value="male"       {{ old('looking_for_gender', $user->profile?->looking_for_gender) === 'male'       ? 'selected' : '' }}>Men</option>
                            <option value="female"     {{ old('looking_for_gender', $user->profile?->looking_for_gender) === 'female'     ? 'selected' : '' }}>Women</option>
                            <option value="non-binary" {{ old('looking_for_gender', $user->profile?->looking_for_gender) === 'non-binary' ? 'selected' : '' }}>Non-binary</option>
                            <option value="any"        {{ old('looking_for_gender', $user->profile?->looking_for_gender) === 'any'        ? 'selected' : '' }}>Everyone</option>
                        </select>
                        <x-input-error :messages="$errors->get('looking_for_gender')" class="mt-2" />
                    </div>

                    {{-- Location --}}
                    <div class="mb-8">
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input
                            id="location"
                            name="location"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('location', $user->profile?->location)"
                            placeholder="e.g. Manila, Philippines"
                            maxlength="100"
                        />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>
                            {{ __('Save Profile') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
