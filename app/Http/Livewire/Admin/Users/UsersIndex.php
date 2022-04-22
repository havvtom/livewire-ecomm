<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;

class UsersIndex extends Component
{
    public $searchQuery;

    protected $listeners = ['editUser'];

    public function editUser( $user )
    {
        return redirect()->route('admin.users.edit', $user['id']);
    }

    public function render()
    {
        $users = User::search($this->searchQuery)->get();

        return view('livewire.admin.users.users-index', [
            'users' => $users
        ]);
    }
}
