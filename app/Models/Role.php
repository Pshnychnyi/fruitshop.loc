<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }

    public function hasPermission($name, $require = false) {
        if(is_array($name)) {
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);

                if($hasPermission && !$require) {
                    return true;
                }elseif(!$hasPermission && $require) {
                    return false;
                }
            }
            return $require;
        }else {
            foreach ($this->permissions()->get() as $permission) {
                if ($permission->name == $name) {
                    return true;
                }
            }
        }
    }

    public function savePermissions($permissions) {
        if(!empty($permissions)) {
            $this->permissions()->sync($permissions);
        }else {
            $this->permissions()->detach();
        }
    }
}
