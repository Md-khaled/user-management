<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Deleted User List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @if (Session::has('success'))
                    <x-alert type="success" :message="Session::get('success')" />
                @endif
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">

                    <a href="{{ route('users.create') }}"
                       class="mb-4 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                        Create
                    </a>

                    <div class="min-w-full align-middle">
                        <table class="w-full min-w-full border divide-y divide-gray-200">
                            <thead>
                            <tr>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Name</span>
                                </th>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Email</span>
                                </th>
                                <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Phone</span>
                                </th>
                                <th class="w-56 bg-gray-50 px-6 py-3 text-left">
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @forelse($deletedUsers as $user)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        {{ $user->email ?? '' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        {{ $user->phone ?? '' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        <span
                                            class="inline-flex items-center  mb-4 rounded-md bg-white text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                          <form action="{{ route('users.restore', $user) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <x-secondary-button :href="route('logout')"
                                                                onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Restore') }}
                                            </x-secondary-button>
                                          </form>
                                        </span>
                                        <form action="{{ route('users.delete', $user) }}" method="POST"
                                              onsubmit="return confirm('Are you sure?')" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button>
                                                {{ __('Permanent Delete') }}
                                            </x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="bg-white px-4 py-2 text-xs font-semibold uppercase font-semibold uppercase tracking-widest text-gray-700 shadow-sm">
                                        <h3 class="text-center">No record exists</h3>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
