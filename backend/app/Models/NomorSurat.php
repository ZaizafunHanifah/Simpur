<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NomorSurat extends Model
{
    protected $table = 'nomor_surat';
    protected $fillable = ['tahun', 'bulan', 'urutan', 'kode_surat'];

    /**
     * Generate Nomor Surat Baru
     * Format: 001/DS-SIMPUR/II/2026
     */
    public static function generateNextNumber($kodeKlasifikasi = '474')
    {
        $now = Carbon::now();
        $year = $now->year;
        $monthRomawi = self::getRomawi($now->month);

        return DB::transaction(function () use ($year, $kodeKlasifikasi, $monthRomawi, $now) {
            // Find or Create counter record for this Year
            $counter = self::firstOrCreate(
                ['tahun' => $year, 'kode_surat' => $kodeKlasifikasi],
                ['urutan' => 0, 'bulan' => $now->month]
            );

            // Increment
            $counter->increment('urutan');
            
            // Format: 01
            $urutanFormatted = str_pad($counter->urutan, 2, '0', STR_PAD_LEFT);
            
            // Full String: 474. /01/II/2026
            return sprintf('%s. /%s/%s/%s', $kodeKlasifikasi, $urutanFormatted, $monthRomawi, $year);
        });
    }

    /**
     * Preview Nomor Selanjutnya tanpa menambah urutan
     */
    public static function peekNextNumber($kodeKlasifikasi = '474')
    {
        $now = Carbon::now();
        $year = $now->year;
        $monthRomawi = self::getRomawi($now->month);

        $counter = self::where('tahun', $year)->where('kode_surat', $kodeKlasifikasi)->first();
        $nextUrutan = ($counter ? $counter->urutan : 0) + 1;
        
        $urutanFormatted = str_pad($nextUrutan, 2, '0', STR_PAD_LEFT);
        return sprintf('%s. /%s/%s/%s', $kodeKlasifikasi, $urutanFormatted, $monthRomawi, $year);
    }

    public static function getRomawi($month)
    {
        $map = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];
        return $map[$month];
    }
}
