<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RoleModel extends Model
{
    //
    protected $table = 'role';

    static public function getSingle($id)
    {
        return RoleModel::find($id);
    }

    static public function getRecord()
    {
        return RoleModel::get();
    }
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
