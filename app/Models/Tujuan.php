<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tujuan extends Model
{
    use HasFactory;
    protected $table = 'tujuan';
    protected $guarded = [];

    public function tugas() {
        return $this->belongsTo(Tugas::class);
    }

}
