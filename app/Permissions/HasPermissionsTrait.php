<?php  

namespace App\Permissions;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Arr;

trait HasPermissionsTrait
{
	public function givePermissionTo(...$permission)
	{
		$permissions = $this->getAllPermissions(Arr::flatten($permission));
		//check if one has permissions
		if( $permissions == null ){
			return $this;
		} 
	}

	protected function getAllPermissions(array $permissions)
	{
		return Permission::whereIn('name', $permissions)->get();
	}

	public function hasPermissionTo($permission)
	{
		//has permission through a role
		return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
	}

	public function hasRole(...$roles)
	{
		foreach( $roles as $role ){
			if( $this->roles->contains('name', $role) ){
				return true;
			}
			return false;
		}
	}

	protected function hasPermissionThroughRole($permission)
	{
		foreach( $permission->roles as $role ){
			if($this->roles->contains($role)){
				return true;
			}
		}
		return false;
	}

	public function roles()
	{
		return $this->belongsToMany( Role::class );
	}

	public function permissions()
	{
		return $this->belongsToMany( Permission::class );
	}

	protected function hasPermission($permission)
	{
		return (bool) $this->permissions->where('name', $permission)->count();
	}
}