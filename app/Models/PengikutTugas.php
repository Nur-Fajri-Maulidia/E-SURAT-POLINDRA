<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengikutTugas extends Model
{
    use HasFactory;
    protected $table = 'pengikut_tugas';
    protected $guarded = [];

    public function tugas() {
        return $this->belongsTo(Tugas::class, 'tugas_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
