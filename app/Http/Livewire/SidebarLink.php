<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SidebarLink extends Component
{
    public $sidebar;

    public function mount($sidebar)
    {
        $this->sidebar = $sidebar;
    }

    public function render()
    {
        return view('livewire.sidebar-link');
    }
}

