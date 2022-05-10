<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;

use Livewire\Component;

class SidebarLink extends Component
{
    public $sidebar;

    public function mount($sidebar)
    {
        $this->sidebar = $sidebar;
    }

    public function show()
    {
        //title is the name of the route and should be name of the view(admin.$sidebar->title)
        // dd('admin.'.Str::lower($this->sidebar['title']));
        return redirect()->route('admin.'.Str::lower($this->sidebar['title']));
    }

    public function render()
    {
        return view('livewire.sidebar-link');
    }
}

