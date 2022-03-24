<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sidebar;

class SidebarIndex extends Component
{
    public function render()
    {

        return view('livewire.sidebar-index', [
            'sidebars' => Sidebar::latest()->get()
        ]);
    }
}
