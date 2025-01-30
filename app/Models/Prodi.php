<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory, HasUuids, AuthenticableTrait;
    protected $table = 'jurusan';
    protected $fillable = [
        'jurusan',
        'status'
    ];
    protected $keyType = 'string';
    protected $primaryKey = 'id_jurusan';
    public $timestamps = true;

}
