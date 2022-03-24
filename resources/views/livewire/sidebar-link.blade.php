<div
  class="flex items-center px-6 py-4 duration-200 {{ Route::is(Illuminate\Support\Str::lower($sidebar->title)) ? 'bg-gray-600 bg-opacity-25 text-white border-gray-100' : 'border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100'}}"
>
<svg
    class="w-5 h-5"
    viewBox="0 0 20 20"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      d="{{$sidebar->path_one}}"
      fill="currentColor"
    />
    <path
      d="{{$sidebar->path_two}}"
      fill="currentColor"
    />
  </svg>

  <span class="mx-4" id="target">{{$sidebar->title}}</span>
</div>
