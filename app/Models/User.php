<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function avatar()
    {
        if($this->foto)
        {
            return asset('storage/' . $this->foto);
        }else{
            return asset('assets/images/faces/face28.jpg');
        }
    }

    public function unit_kerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id', 'id');
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function getDocument()
    {
        return $this->belongsTo(Document::class);
    }

    public function getPermissions($permission)
    {
        return $this->roles->map(function ($role) {
            return $role->permissions;
        })->collapse()->unique()->where('name',$permission)->first();
        // return $this->roles()->first()->getAllPermissions();
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function pengikutTugas()
    {
        return $this->hasMany(PengikutTugas::class);
    }

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class);
    }
}
