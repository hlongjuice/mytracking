<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    protected $table="member";

    protected $fillable=['username','password'];

    public function package(){
        return $this->belongsToMany('App\Models\Package','member_package','member_id','package_id');
    }

    public function memberType(){
        return $this->belongsTo('App\Models\MemberType','member_type_id');
    }

}