<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'azhrms_user_role';
    protected $fillable = [
        'name', 'display_name',
    ];
}
