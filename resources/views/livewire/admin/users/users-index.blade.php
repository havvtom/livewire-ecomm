<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="p-4">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" wire:model.debounce.500ms="searchQuery" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
        </div>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email Address
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone Number
                </th>
                <!-- if authenticated user can edit user to give permissions or give a role -->
               
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{$user->name}}
                </th>
                <td class="px-6 py-4">
                    {{$user->email}}
                </td>
                <!-- <td class="px-6 py-4">
                    Laptop
                </td> -->
                <td class="px-6 py-4">
                    {{$user->phone_number}}
                </td>
                @can('give permissions')
                <td class="px-6 py-4 text-right">
                    <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="$emit('editUser', {{$user}})">Edit</button>
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- <div class="sm:flex sm:justify-between mt-4 flex-wrap">
    <a type="button" href="{{route('admin.create')}}" class="text-white cursor-pointer bg-[#4C51BF] hover:bg-[#2557D6]/90 focus:ring-4 focus:ring-[#2557D6]/50 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#2557D6]/50 mr-2 mb-2">
        
        ADD NEW PRODUCT
    </a>
    
</div> -->

