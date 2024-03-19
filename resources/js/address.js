
let addressCounter = 1;
export function addAddress() {
    addressCounter++;
    const addressFields = document.getElementById('address-fields');
    const newAddress = document.createElement('div');
    newAddress.classList.add('address');
    newAddress.innerHTML = `
        <div class="mt-4">
            <x-input-label for="street" :value="__('Street')" />
            <x-text-input name="addresses[${addressCounter}][street]" type="text" class="block mt-1 w-full" />
        </div>
        <div class="mt-4">
            <x-input-label for="city" :value="__('City')" />
            <x-text-input name="addresses[${addressCounter}][city]" type="text" class="block mt-1 w-full" />
        </div>
        <div class="mt-4">
            <x-input-label for="state" :value="__('State')" />
            <x-text-input name="addresses[${addressCounter}][state]" type="text" class="block mt-1 w-full" />
        </div>
        <div class="mt-4">
            <x-input-label for="postal_code" :value="__('Postal Code')" />
            <x-text-input name="addresses[${addressCounter}][postal_code]" type="text" class="block mt-1 w-full" />
        </div>
        <div class="mt-4">
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input name="addresses[${addressCounter}][country]" type="text" class="block mt-1 w-full" />
        </div>
        <button type="button" class="mt-2 remove-address" onclick="removeAddress(this)">
            <i class="fas fa-minus-circle"></i> Remove Address
        </button>
    `;
    addressFields.appendChild(newAddress);
}

export function removeAddress(button) {
    const address = button.parentElement;
    address.remove();
    addressCounter--;
}

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
        } else {
            alert('Please fill in all address fields.');
        }
    }
