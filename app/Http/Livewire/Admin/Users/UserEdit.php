<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\Permission;

class UserEdit extends Component
{
    public $user;
    public $permissionsGiven;
    public $permissionsWithdrawn;

    protected $listeners = ['refreshPermissions' => '$refresh'];

    public function givePermissions()
    {
        //Validate
        $this->user->givePermissionTo($this->permissionsGiven);
        //Refresh page after adding permissions
        $this->emit('refreshPermissions');
    }

    public function withdrawPermissions()
    {
        $this->user->withdrawPermissionTo($this->permissionsWithdrawn);
        //Refresh page after adding permissions
        $this->emit('refreshPermissions');
    }

    public function render()
    {
        //difference between available permissions and the permissions the user has 
        $permissions = Permission::get()->diff($this->user->permissions);

        return view('livewire.admin.users.user-edit', [
            'permissions' => $permissions,
        ]);
    }
}
