<div class="p-6 bg-white border-b border-gray-200">
    <p class="mb-6 text-xl font-bold text-gray-600 underline ">
        Subscribers
    </p>
    <div class="px-8">
        <x-input
            type="text"
            class="float-right pl-8 mb-4 border border-gray-300 rounded-lg "
            placeholder="Search"
            wire:model="search"
            >
        </x-input>
        @if ($subscribers->isEmpty())
            <div class="flex w-full p-5 bg-red-100 rounded-lg">
                <p class="text-red-400 ">
                    No subscribers found
                </p>
            </div>
        @else
            <table class="w-full">
                <thead class="text-indigo-600 border-b-2 border-gray-300 ">
                    <tr>
                        <th class="px-6 py-3 text-left ">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left ">
                            Verified
                        </th>
                        <th class="px-6 py-3 text-left ">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscribers as $subscriber)
                    {{--
                        *   Null coalescing operator,
                            devulve lo que esta en la variable, si esta es distinta != null
                            de lo contrario ejecuta lo que esta despues de ?? que seria el string 'null'
                            $algo ?? 'null'
                        *   optional($algo)->method() = null
                            Si el objeto dado es nulo, las propiedades y los métodos devolverán un valor
                            nulo en lugar de causar un error.
                    --}}
                        <tr class="text-sm text-indigo-900 border-b border-gray-400 ">
                            <td class="px-6 py-4"> {{ $subscriber->email }} </td>
                            <td class="px-6 py-4"> {{ optional($subscriber->email_verified_at)->diffForHumans() ?? 'Never' }} </td>
                            <td class="px-6 py-4">
                                <x-button
                                    class="text-red-500 border border-red-500 hover:bg-red-100 bg-red-50"
                                    wire:click="delete({{ $subscriber->id }})"
                                    >
                                    Delete
                                </x-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
