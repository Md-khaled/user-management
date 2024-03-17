<div id="address-fields">
    <div class="address">
       <div class="mt-4">
            <x-input-label for="street" :value="__('Street')" />
            <x-text-input id="street" 
            name="addresses[0][street]" 
            type="text" 
            class="block mt-1 w-full" />
            <!-- <x-input-error :messages="$errors->get('addresses.*.street')" class="mt-2" /> -->
       </div>

       <div class="mt-4">
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" 
            name="addresses[0][city]" 
            type="text" 
            class="block mt-1 w-full" />
            <!-- <x-input-error :messages="$errors->get('addresses.*.city')" class="mt-2" /> -->
        </div>

        <div class="mt-4">
            <x-input-label for="state" :value="__('State')" />
            <x-text-input id="state" 
            name="addresses[0][state]"
            type="text"
            class="block mt-1 w-full" />
            <!-- <x-input-error :messages="$errors->get('addresses.*.state')" class="mt-2" /> -->
        </div>

        <div class="mt-4">
            <x-input-label for="postal_code" :value="__('Postal Code')" />
            <x-text-input id="postal_code" 
            name="addresses[0][postal_code]" 
            type="text" 
            class="block mt-1 w-full" />
            <!-- <x-input-error :messages="$errors->get('addresses.*.postal_code')" class="mt-2" /> -->
        </div>
        <div class="mt-4">
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input id="country" 
            name="addresses[0][country]" 
            type="text" 
            class="block mt-1 w-full" />
            <!-- <x-input-error :messages="$errors->get('addresses.*.country')" class="mt-2" /> -->
        </div>

        <button type="button" class="mt-2 remove-address">
            <i class="fas fa-minus-circle"></i>
        </button>
    </div>
</div>

<button type="button" id="add-address" class="float-right"><i class="fas fa-plus-circle"></i></button>
<script>
    let addressCount = 1;

document.getElementById('add-address').addEventListener('click', function () {
    const addressFields = document.getElementById('address-fields');
    const newAddress = document.createElement('div');
    newAddress.classList.add('address');
    newAddress.innerHTML = `
        <div class="mt-4">
            <x-input-label for="street" :value="__('Street')" />
            <x-text-input name="addresses[${addressCount}][street]" type="text" class="block mt-1 w-full" />
        </div>
        <div class="mt-4">
            <x-input-label for="city" :value="__('City')" />
            <x-text-input name="addresses[${addressCount}][city]" type="text" class="block mt-1 w-full" />
        </div>
        <div class="mt-4">
            <x-input-label for="state" :value="__('State')" />
            <x-text-input name="addresses[${addressCount}][state]" type="text" class="block mt-1 w-full" />
        </div>
        <div class="mt-4">
            <x-input-label for="postal_code" :value="__('Postal Code')" />
            <x-text-input name="addresses[${addressCount}][postal_code]" type="text" class="block mt-1 w-full" />
        </div>
        <div class="mt-4">
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input name="addresses[${addressCount}][country]" type="text" class="block mt-1 w-full" />
        </div>
        <button type="button" class="mt-2 remove-address">
            <i class="fas fa-minus-circle"></i> Remove Address
        </button>
    `;
    addressFields.appendChild(newAddress);
    addressCount++;
});

document.getElementById('address-fields').addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-address') && addressCount > 1) {
        event.target.parentNode.remove();
        addressCount--;
    }
});

function validateData() {
        var streets = document.querySelectorAll('.street');
        var cities = document.querySelectorAll('.city');
        var states = document.querySelectorAll('.state');
        var postalCodes = document.querySelectorAll('.postal_code');
        var countries = document.querySelectorAll('.country');

        var isValid = true;

        // Check if any address field is empty
        streets.forEach(function(element) {
            if (element.value.trim() === '') {
                isValid = false;
            }
        });
        cities.forEach(function(element) {
            if (element.value.trim() === '') {
                isValid = false;
            }
        });
        states.forEach(function(element) {
            if (element.value.trim() === '') {
                isValid = false;
            }
        });
        postalCodes.forEach(function(element) {
            if (element.value.trim() === '') {
                isValid = false;
            }
        });
        countries.forEach(function(element) {
            if (element.value.trim() === '') {
                isValid = false;
            }
        });

        if (isValid) {
            alert('Validation successful. Proceed with submission.');
            // Here you can submit the form or perform any other action
        } else {
            alert('Please fill in all address fields.');
        }
    }
</script>
