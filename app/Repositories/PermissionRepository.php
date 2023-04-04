<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Models\Role;

class PermissionRepository extends Repository
{
    private $rol_rep;

    public function __construct(Permission $permission, Role $rol_rep) {
        $this->model = $permission;
        $this->rol_rep = $rol_rep;
    }

    public function changePermission($request) {
        $data = $request->except('_token');
        if(empty($data)) {
            return ['error' => 'Нет данных'];
        }
        $roles = $this->rol_rep->get();

        foreach($roles as $role) {
            if(isset($data[$role->id])){
                $role->savePermissions($data[$role->id]);
            }else {
                $role->savePermissions([]);
            }
        }
        return ['success' => 'Изменения сохранены'];



    }

}
