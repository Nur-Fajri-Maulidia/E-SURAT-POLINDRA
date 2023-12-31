<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // public function child()
    // {
    //     return $this->belongsTo(UnitKerja::class,'parent_id','id');
    // }

    public function role_unit()
    {
        return $this->hasOne(RoleUnitKerja::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
