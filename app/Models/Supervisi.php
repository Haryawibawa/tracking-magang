<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisi extends Model
{
    use HasFactory, HasUuids, AuthenticableTrait;
    protected $table = 'supervisi';
    protected $fillable = [
        'nama',
        'email',
        'status',
        'pangkat',
    ];
    protected $keyType = 'string';
    protected $primaryKey = 'id_spv';

    public function pegawai(){
        return $this->belongsTo(User::class, 'id_spv');
    }
    public function spv(){
        return $this->belongsTo(Mahasiswa::class, 'id_spv');
    }
}
