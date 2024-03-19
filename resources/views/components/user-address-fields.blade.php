@props(['address', 'key', 'total'])
<div id="address-fields" data-address-counter="{{ $total }}" >
    <div class="address">
    <x-text-input 
            name="addresses[{{ $key }}][address_id]"
            value="{{$address ? $address->id : ''}}"
            type="hidden" />
       <div class="mt-4">
            <x-input-label for="street" :value="__('Street')" />
            <x-text-input id="street" 
            name="addresses[{{ $key }}][street]" 
            value="{{$address ? $address->street : ''}}"
            type="text" 
            class="block mt-1 w-full" />
            <!-- <x-input-error :messages="$errors->get('addresses.*.street')" class="mt-2" /> -->
       </div>

       <div class="mt-4">
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" 
            name="addresses[{{ $key }}][city]" 
            type="text" 
            value="{{$address ? $address->city : ''}}"
            class="block mt-1 w-full" />
            <!-- <x-input-error :messages="$errors->get('addresses.*.city')" class="mt-2" /> -->
        </div>

        <div class="mt-4">
            <x-input-label for="state" :value="__('State')" />
            <x-text-input id="state" 
            name="addresses[{{ $key }}][state]"
            value="{{$address ? $address->state : ''}}"
            type="text"
            class="block mt-1 w-full" />
            <!-- <x-input-error :messages="$errors->get('addresses.*.state')" class="mt-2" /> -->
        </div>

        <div class="mt-4">
            <x-input-label for="postal_code" :value="__('Postal Code')" />
            <x-text-input id="postal_code" 
            name="addresses[{{ $key }}][postal_code]" 
            type="text"
            value="{{$address ? $address->postal_code : ''}}" 
            class="block mt-1 w-full" />
            <!-- <x-input-error :messages="$errors->get('addresses.*.postal_code')" class="mt-2" /> -->
        </div>
        <div class="mt-4">
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input id="country" 
            name="addresses[{{ $key }}][country]" 
            type="text" 
            value="{{$address ? $address->country : ''}}"
            class="block mt-1 w-full" />
            <!-- <x-input-error :messages="$errors->get('addresses.*.country')" class="mt-2" /> -->
        </div>

        <button type="button" class="mt-2 remove-address" onclick="removeAddress(this)">
            <i class="fas fa-minus-circle"></i>Remove Address
        </button>
    </div>
</div>

