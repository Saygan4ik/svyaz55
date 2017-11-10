<?php

namespace App\Repositories;

use App\Permission;

class PermissionRepository extends BaseRepository {

    public function __construct(Permission $permission) {
        return $this->model = $permission;
    }
}