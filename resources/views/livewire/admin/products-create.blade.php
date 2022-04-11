<p class="text-2xl font-extrabold dark:text-white">Add Product</p>
    <div class="grid grid-cols-2 gap-4 mt-8">
        
        <div class="">
            <form>
              <div class="mb-6">
                <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Product Name</label>
                <input type="text" id="product" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nike Airforce" required>
              </div>
              <div class="mb-6">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Product Description</label>
                <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Describe product..."></textarea>
              </div>
              <div class="mb-6">
                  <label class="block mb-2 text-gray-600" for="Multiselect">Categories</label>
                  <div class="relative flex w-full">
                    <select
                      class="block w-full p-3 border border-gray-300 rounded-sm cursor-pointer focus:outline-none"
                      multiple>
                      @foreach($categories as $category)
                      <option value="1">{{$category->title}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>            
            </form>
        </div>
        <div class="">
            <label class="inline-block mb-2 text-gray-500">Upload
                Image(jpg,png,svg,jpeg)</label>
            <div class="flex items-center justify-center w-full">
                <label class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300">
                    <div class="flex flex-col items-center justify-center pt-7">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-12 h-12 text-gray-400 group-hover:text-gray-600" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                            Select a photo</p>
                    </div>
                    <input type="file" class="opacity-0" />
                </label>
            </div>
        </div>
    </div>
