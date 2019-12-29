<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RolePermission extends Pivot
{
    protected $table = 'role_permission';

    public function getPermisisonIdByRoleId($id)
    {
        return $this->where('role_id', $id)->pluck('permission_id');
    }
}
