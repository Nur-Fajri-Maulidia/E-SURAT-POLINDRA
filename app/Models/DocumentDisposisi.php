<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentDisposisi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function units()
    {
        return $this->hasMany(DocumentDisposisiUnit::class);
    }

    public function penerima()
    {
        return $this->hasMany(DocumentDisposisiUnit::class, 'document_disposisi_id', 'id');
    }

    public function getDocument()
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }

}
