@props(['user', 'isEdit', 'isReadOnly'])

<div class="mt-4">
    <x-input-label for="prefixname" :value="__('Prefix Name')" />
    <select id="prefixname" name="prefixname" class="block mt-1 w-full">
        <option value="" @if (old('prefixname', $user->prefixname ?? '') == '') selected @endif>Select prefix</option>
        @foreach(['Mr', 'Mrs', 'Ms'] as $prefix)
            <option value="{{ $prefix }}" @if (old('prefixname', $user->prefixname ?? '') == $prefix) selected @endif>{{ $prefix }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('prefixname')" class="mt-2" />
</div>

@foreach(['firstname' => 'First Name', 'middlename' => 'Middle Name', 'lastname' => 'Last Name', 'suffixname' => 'Suffix Name'] as $field => $label)
    <div class="mt-4">
        <x-input-label for="{{ $field }}" :value="__($label)" />
        <x-text-input id="{{ $field }}"
                      name="{{ $field }}"
                      :value="old($field, $user->$field ?? '')"
                      type="text"
                      class="block mt-1 w-full" />
        <x-input-error :messages="$errors->get($field)" class="mt-2" />
    </div>
@endforeach

<div class="mt-4">
    <x-input-label for="username" :value="__('Username')" />
    <x-text-input id="username"
                  name="username"
                  :value="old('username', $user->username ?? '')"
                  type="text"
                  class="block mt-1 w-full" />
    <x-input-error :messages="$errors->get('username')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="mt-1 block w-full"
                  name="email"
                  :value="old('email', $user->email ?? '')"
                  type="email"
                  autocomplete="username" />
    <x-input-error class="mt-2" :messages="$errors->get('email')" />
</div>

@if(!isset($isEdit) || !$isEdit)
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="block mt-1 w-full"
                      type="password"
                      name="password"
                      autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                      type="password"
                      name="password_confirmation"
                      autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>
@endif

<div class="mt-4">
    <x-input-label for="photo" class="block font-medium text-sm text-gray-700" :value="__('Photo')" />
    <x-text-input id="photo" class="mt-1 p-2 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full"
                  type="file"
                  name="photo"
                  autocomplete="photo" />
    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="type" :value="__('User Type')" />
    <select id="type" name="type" class="block mt-1 w-full">
        @foreach(['user', 'admin'] as $type)
            <option value="{{ $type }}" @if (old('type', $user->type ?? 'user') == $type) selected @endif>{{ ucfirst($type) }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('type')" class="mt-2" />
</div>
