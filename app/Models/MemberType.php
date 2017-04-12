<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberType extends Model
{
    protected $table='member_type';

    public function member(){
        return $this->hasMany('App\Models\Member','member_type_id');
    }
}
