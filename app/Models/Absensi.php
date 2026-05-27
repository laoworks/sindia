<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'user_id',
        'tanggal',
        'waktu_masuk',
        'waktu_pulang',
        'foto_masuk',
        'foto_pulang',
        'status_masuk',
        'status_pulang',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_masuk' => 'datetime',
        'waktu_pulang' => 'datetime',
    ];

    // Relasi ke User (Guru)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
}
