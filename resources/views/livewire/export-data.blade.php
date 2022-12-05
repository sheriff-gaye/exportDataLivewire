<div>
    <div class="font-sans antialiased text-gray-900">
        <div class="flex flex-col items-center pt-5 pb-5 sm:justify-center">
            <h2 class="text-2xl font-bold">Livewire Export Data to (CSV, PDF, XLS)</h2>

            <div class="w-full px-6 py-8 mt-6 mb-6 bg-white shadow-2xl sm:max-w-2xl sm:rounded-lg">
                <div>
                    @if (session()->has('message'))
                        <div class="px-3 py-2 mb-2 text-center text-red-500 bg-red-200 rounded" x-data="{ show: true }"
                            x-init="setTimeout(() => show = false, 4000)" x-show="show">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (session()->has('download'))
                        <div class="px-3 py-2 mb-2 text-center text-green-800 bg-green-400 rounded"
                            x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                            {{ session('download') }}
                        </div>
                    @endif
                    <div class="flex justify-between gap-2 mb-4">

                        <input type="search" class="text-sm rounded-2xl" placeholder="Search Data"
                            wire:model.debounce='search'>

                        <div class="flex justify-end gap-2">
                            <a class="px-2 py-2 text-sm text-white bg-gray-500 rounded hover:bg-gray-800"
                                wire:click='exportToSvc'>SVC</a>

                            <a class="px-2 py-2 text-sm text-white bg-green-600 rounded hover:bg-green-800"
                                wire:click='exportToXsl'>XSL</a>

                            <a class="px-2 py-2 text-sm text-white bg-red-600 rounded hover:bg-red-800"
                                wire:click='exportToPdf'>PDF</a>

                        </div>
                    </div>

                    <table class="min-w-full">
                        <thead>
                            <tr  class="text-center uppercase">
                                <th
                                    class="px-6 py-3 text-sm leading-4 tracking-wider text-left border-b-2 border-gray-300">
                                    <input type="checkbox" wire:click='selectAll' wire:model='selectall'
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </th>
                                <th
                                    class="px-6 py-3 text-sm leading-4 tracking-wider text-left border-b-2 border-gray-300 ">
                                    Title</th>
                                <th
                                    class="px-6 py-3 text-sm leading-4 tracking-wider text-left border-b-2 border-gray-300">
                                    Name</th>
                                    <th
                                    class="px-6 py-3 text-sm leading-4 tracking-wider text-left border-b-2 border-gray-300">
                                    Gender</th>

                                <th
                                    class="px-6 py-3 text-sm leading-4 tracking-wider text-left border-b-2 border-gray-300">
                                    Email</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse ($datas as $data)
                                <tr>
                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-500">
                                        <input type="checkbox" name="selected" wire:model='selected'
                                            wire:key='{{ $data->id }}' value="{{ $data->id }}"
                                            {{ $selectall == true ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                    </td>

                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-500">
                                        {{ $data->first_name }}</td>
                                    <td
                                        class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-500 ">
                                        {{ $data->last_name }}</td>

                                        <td
                                        class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-500 ">
                                        {{ $data->gender }}</td>

                                    <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-500">
                                        {{ $data->email }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-6 py-4 leading-5 text-center whitespace-no-wrap border-b border-gray-500">
                                        No
                                        Records</td>

                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


            </div>
            <p class="text-gray-500">Developer Sheriff Gaye &copy; 2022</p>

        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
