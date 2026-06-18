<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'user_id',
        'tanggal',
        'jadwal_id',
        'waktu_masuk',
        'waktu_pulang',
        'foto_masuk',
        'foto_pulang',
        'status_masuk',
        'status_pulang',
        'ip_address',
        'user_agent'
    ];

    // ============================================
    // PERBAIKI CASTS - TAMBAHKAN FORMAT SPESIFIK
    // ============================================
    protected $casts = [
        'tanggal' => 'date:Y-m-d',           // ← HANYA TANGGAL (tanpa 00:00:00)
        'waktu_masuk' => 'datetime:H:i:s',   // ← HANYA JAM
        'waktu_pulang' => 'datetime:H:i:s',  // ← HANYA JAM
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ============================================
    // TAMBAHKAN ACCESSORS UNTUK FORMAT LAIN
    // ============================================

    // Tanggal Indonesia (contoh: Kamis, 18 Juni 2026)
    public function getTanggalIndonesiaAttribute()
    {
        return Carbon::parse($this->tanggal)->isoFormat('dddd, D MMMM YYYY');
    }

    // Tanggal short (contoh: 2026-06-18)
    public function getTanggalShortAttribute()
    {
        return Carbon::parse($this->tanggal)->format('Y-m-d');
    }

    // Jam masuk (contoh: 16:19:30)
    public function getJamMasukAttribute()
    {
        return $this->waktu_masuk ? Carbon::parse($this->waktu_masuk)->format('H:i:s') : '-';
    }

    // Jam pulang (contoh: 16:21:17)
    public function getJamPulangAttribute()
    {
        return $this->waktu_pulang ? Carbon::parse($this->waktu_pulang)->format('H:i:s') : '-';
    }

    // Scope untuk filter tanggal
    public function scopeTanggal($query, $tanggal)
    {
        return $query->whereDate('tanggal', $tanggal);
    }

    // Accessor untuk status badge
    public function getStatusMasukBadgeAttribute()
    {
        if ($this->status_masuk == 'tepat_waktu') {
            return '<span class="badge bg-success">Tepat Waktu</span>';
        } elseif ($this->status_masuk == 'terlambat') {
            return '<span class="badge bg-danger">Terlambat</span>';
        }
        return '<span class="badge bg-secondary">Belum Absen</span>';
    }

    public function getStatusPulangBadgeAttribute()
    {
        if ($this->status_pulang == 'tepat_waktu') {
            return '<span class="badge bg-success">Tepat Waktu</span>';
        } elseif ($this->status_pulang == 'lebih_awal') {
            return '<span class="badge bg-warning">Lebih Awal</span>';
        }
        return '<span class="badge bg-secondary">Belum Pulang</span>';
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
