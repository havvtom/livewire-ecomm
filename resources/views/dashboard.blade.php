<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 grid sm:grid-cols-5 border-b border-gray-200">
                    <div class="bg-gray-700 flex flex-col">
                        <div class="flex items-center justify-center mt-8">
                            <div class="flex items-center">
                              <svg
                                class="w-12 h-12"
                                viewBox="0 0 512 512"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                                  fill="#4C51BF"
                                  stroke="#4C51BF"
                                  stroke-width="2"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                                <path
                                  d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                                  fill="white"
                                />
                              </svg>

                              <span class="mx-2 text-2xl font-semibold text-white"
                                >V-Dashboard</span
                              >
                            </div>
                        </div>
                        <div class="mt-10">
                        <div
                          class="flex items-center px-6 py-2 mt-4 duration-200 {{ Route::is('dashboard') ? 'bg-gray-600 bg-opacity-25 text-white border-gray-100' : 'border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100'}}"
                        >
                          <svg
                            class="w-5 h-5"
                            viewBox="0 0 20 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M2 10C2 5.58172 5.58172 2 10 2V10H18C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10Z"
                              fill="currentColor"
                            />
                            <path
                              d="M12 2.25195C14.8113 2.97552 17.0245 5.18877 17.748 8.00004H12V2.25195Z"
                              fill="currentColor"
                            />
                          </svg>

                          <span class="mx-4" id="target">Dashboard</span>
                        </div>
                        <div
                          class="flex items-center px-6 py-2 mt-4 duration-200 {{ Route::is('home') ? 'bg-gray-600 bg-opacity-25 text-white border-gray-100' : 'border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100'}}"
                        >
                          <svg
                            class="w-5 h-5"
                            viewBox="0 0 20 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M2 10C2 5.58172 5.58172 2 10 2V10H18C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10Z"
                              fill="currentColor"
                            />
                            <path
                              d="M12 2.25195C14.8113 2.97552 17.0245 5.18877 17.748 8.00004H12V2.25195Z"
                              fill="currentColor"
                            />
                          </svg>

                          <span class="mx-4" id="target">Dashboard</span>
                        </div>
                    </div>
                    </div>
                    <div class="bg-blue-700 col-span-4">Blue</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

