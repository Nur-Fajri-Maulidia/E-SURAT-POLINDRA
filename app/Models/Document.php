<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'tte_created' => 'datetime',
        'tte_visum_umum_created' => 'datetime',
        'tte_spd_created' => 'datetime'
    ];
    protected $appends = ['index'];

    public function getIndexAttribute()
    {
        static $counter = 0;
        return ++$counter;
    }


    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function unit_kerja()
    {
        return $this->belongsTo(UnitKerja::class, 'to_unit_kerja_id', 'id');
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }

    public function user_id()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(DocumentAttachment::class);
    }

    public function details()
    {
        return $this->hasMany(DocumentDetails::class);
    }

    public function scopeOutboxbyuser($query)
    {
        return $query->where('from_user_id', auth()->id());
    }

    public function scopeInboxbyuser($query)
    {
        $data = $query->whereHas('getDisposisi', function ($q) {
            $q->whereHas('units', function ($u) {
                $u->where('unit_kerja_id', auth()->user()->unit_kerja_id);
            });
        });

        return $data;
    }

    public function tte_created_user()
    {
        return $this->belongsTo(User::class, 'tte_created_user_id', 'id');
    }

    public function tte_visum_umum_created_user()
    {
        return $this->belongsTo(User::class, 'tte_visum_umum_created_user_id', 'id');
    }
    public function tte_spd_created_user()
    {
        return $this->belongsTo(User::class, 'tte_visum_umum_created_user_id', 'id');
    }

    public function getTembusanUser()
    {
        return $this->belongsTo(User::class, 'to_tembusan_user_id', 'id');
    }


    public function qrcode()
    {
        return asset($this->qrcode);
    }

    public function qrcodeVisumUmum()
    {
        return asset('storage/' . $this->visum_umum_qrcode);
    }
    public function qrcodeSpd()
    {
        return asset('storage/' . $this->spd_qrcode);
    }

    public static function getNewCode($category_id)
    {
        $latest = Document::latest()->first();
        $category = Category::findOrFail($category_id);
        if (!$latest) {
            $kode = '0001/PL42/' . $category->code . '/' . Carbon::now()->format('Y');
        } else {
            $kode_lama = Str::before($latest->no_surat, '/PL42');
            $kode_baru = str_pad($kode_lama + 1, 4, '0', STR_PAD_LEFT);
            $kode = $kode_baru . '/' . 'PL42/' . $category->code . '/' . Carbon::now()->format('Y');
        }

        return $kode;
    }

    public function disposisi()
    {
        return $this->hasOne(DocumentDisposisi::class, 'document_id');
    }

    public function getDisposisi()
    {
        return $this->hasMany(DocumentDisposisi::class, 'document_id', 'id');
    }
}
