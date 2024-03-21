<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">

                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <x-user-info :user="[]"/>

                         <!-- Address Fields Component -->
                        <x-user-address-fields :address="[]" :key="0" :total="0" />
                        <button type="button" id="add-address" class="float-right" onclick="addAddress()">
                            <i class="fas fa-plus-circle"></i>Add Address
                        </button>
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
<script>
const totalAddress = document.getElementById('address-fields').getAttribute('data-address-counter') ?? 1;
let addressCounter = totalAddress;
 function addAddress() {
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

 function removeAddress(button) {
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

</script>
