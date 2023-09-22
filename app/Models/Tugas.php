<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';
    protected $guarded = [];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tujuan()
    {
        return $this->hasMany(Tujuan::class);
    }

    public function pengikutTugas()
    {
        return $this->hasMany(PengikutTugas::class);
    }

}
