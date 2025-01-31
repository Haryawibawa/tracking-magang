<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'logbook';
    protected $primaryKey = 'id_loogbook';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_loogbook',
        'nim',
        'nama',
        'deskripsi',
        'picture',
        'status',
        'id_spv'
    ];

    public function nimmhs()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }
    public function spv()
    {
        return $this->belongsTo(Supervisi::class, 'id_spv');
    }
}
