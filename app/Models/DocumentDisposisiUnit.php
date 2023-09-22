<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentDisposisiUnit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function unit()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function hasDocument()
    {
        return $this->belongsTo(DocumentDisposisi::class, 'document_disposisi_id', 'id');
    }
}
