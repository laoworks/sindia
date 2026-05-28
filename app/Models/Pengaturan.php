<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = [
        'key',
        'value',
        'tipe',
        'description',
    ];

    private function setting($key, $default = null)
    {
        return Pengaturan::where('key', $key)->value('value') ?? $default;
    }
}
