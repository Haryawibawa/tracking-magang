<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory, HasUuids, AuthenticableTrait;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'nim',
        'namamhs',
        'alamatmhs',
        'emailmhs',
        'nohpmhs',
        'jeniskelamin',
        'agama',
        'tempatlahirmhs',
        'tanggallahirmhs',
        'posisi',
        'id_univ',
        'id_fakultas',
        'id_jurusan',
        'id_spv',
        'foto',
        'status'
    ];
    protected $keyType = 'string';
    protected $primaryKey = 'nim';
    public $timestamps = true;

    public function nim(){
        return $this->belongsTo(User::class, 'nim');
    }

    public function jurusan()
    {
        return $this->belongsTo(Prodi::class, 'id_jurusan');
    }
    public function univ()
    {
        return $this->belongsTo(Universitas::class, 'id_univ');
    }
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas');
    }
}
