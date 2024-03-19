<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('User Details') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                        <x-user-info :user="$user"/>
                        <!-- Address Fields Component -->
                        @foreach($user->addresses as $address) 
                            <x-user-address-fields :address="$address" :key="$loop->index" :total="$user->addresses->count()" />
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 