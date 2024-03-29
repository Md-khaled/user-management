@props(['user', 'isEdit', 'isReadOnly'])

<div class="mt-4">
    <x-input-label for="name" :value="__('Name')" />
    <x-text-input id="name"
        name="name"
        :value="old('name', $user ? $user->name : '')"
        type="text" class="block mt-1 w-full" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>
<div class="mt-4">
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="mt-1 block w-full"
        name="email"
        :value="old('email', $user ? $user->email : '')"
        type="email"
        autocomplete="username" />
    <x-input-error class="mt-2" :messages="$errors->get('email')" />
</div>
<div class="mt-4">
    <x-input-label for="phone" :value="__('Phone')" />
    <x-text-input id="phone"
        name="phone"
        :value="old('phone', $user ? $user->phone : '')"
        type="text"
        class="block mt-1 w-full" />
    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
</div>

<div class="{{isset($isEdit) && $isEdit ? 'hidden' : ''}}">
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
</div>
<div class="mt-4">
    <x-input-label for="photo" class="block font-medium text-sm text-gray-700" :value="__('Photo')" />
    <x-text-input id="photo" class="mt-1 p-2 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full"
        type="file"
        name="file"
        autocomplete="photo" />
        <x-input-error :messages="$errors->get('file')" class="mt-2" />
</div>
