<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Company') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
 
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" 
                                name="name" 
                                :value="old('name')"
                                type="text" class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="mt-1 block w-full" 
                                name="email"
                                :value="old('email')" 
                                type="email" 
                                autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" 
                                name="phone" 
                                :value="old('phone')"
                                type="text" 
                                class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation"
                                autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="photo" class="block font-medium text-sm text-gray-700" :value="__('Photo')" />
                            <x-text-input id="photo" class="mt-1 p-2 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full"
                                type="file"
                                name="file"
                                autocomplete="new-password" />
                            
                        </div>

                         <!-- Address Fields Component -->
                        <x-user-address-fields />
                        <div class="mt-4">
                            <x-primary-button>
                                Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>