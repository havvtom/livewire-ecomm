<div>
    <form wire:submit.prevent="givePermissions">
        <div class="mb-6">
            <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
            <input type="text" id="product" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$user->name}}" disabled>
        </div>
        <div class="mb-6">
            <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email Address</label>
            <input type="text" id="product" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$user->email}}" disabled>
        </div>
        <div class="mb-6">
            <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cell Number</label>
            <input type="text" id="product" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$user->cell_number}}" disabled>
        </div>
        @if(auth()->user()->can('give permissions'))
        <div class="mb-6">
          <label class="block mb-2 text-gray-600" for="Multiselect">Give permission to</label>
          <div class="relative flex w-full">
            <select
              class="block w-full p-3 border border-gray-300 rounded-sm cursor-pointer focus:outline-none"
              multiple wire:model="permissionsGiven">
              @foreach($permissions as $permission)
              <option value="{{$permission->name}}">{{$permission->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <x-button type="submit">Add Permissions</x-button> 
        @endif       
    </form>
    @if($user->permissions->count())
    <form class="mt-6" wire:submit.prevent="withdrawPermissions">
        <div class="mb-6">
          <label class="block mb-2 text-gray-600" for="Multiselect">Withdraw permission(s) to</label>
          <div class="relative flex w-full">
            <select
              class="block w-full p-3 border border-gray-300 rounded-sm cursor-pointer focus:outline-none"
              multiple wire:model="permissionsWithdrawn">
              @foreach($user->permissions as $permission)
              <option value="{{$permission->name}}">{{$permission->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <x-button type="submit">Withdraw Permissions</x-button>
    </form>
    @endif
</div>
