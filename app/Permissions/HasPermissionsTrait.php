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

		// dd($permissions);

		//check if permissions is not null so that we can save to the database
		//if there are no permissions an error is given whe we call saveMany
		if( $permissions == null ){
			return $this;
		} 

		//attach the permissions to the user by saveMany
		$this->permissions()->saveMany($permissions);
	}

	public function withdrawPermissionTo(...$permission)
	{
		$permissions = $this->getAllPermissions(Arr::flatten($permission));

		//no need to check if $permissions is not null 
		//detach can work if we pass null
		$this->permissions()->detach($permissions);

		return $this;
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
		return (bool) $this->permissions->where('name', $permission->name)->count();
	}
}