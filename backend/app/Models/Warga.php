<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'warga';

    protected $fillable = [
        'user_id',
        'nik',
        'no_kk',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'pekerjaan',
        'status_perkawinan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
