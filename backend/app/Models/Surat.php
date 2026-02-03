<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    
    protected $fillable = [
        'uuid',
        'warga_id',
        'template_surat_id',
        'nomor_surat_final',
        'urutan_surat',
        'status',
        'data_input',
        'verified_by',
        'signed_by',
        'signed_at',
        'file_path',
        'penandatangan_nama',
        'penandatangan_jabatan'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function templateSurat()
    {
        return $this->belongsTo(TemplateSurat::class);
    }
}
