<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Fakultas extends Model
{
    use HasFactory, HasUuids, AuthenticableTrait;
    protected $table = 'fakultas';
    protected $fillable = [
        'fakultas',
        'status'
    ];
    protected $keyType = 'string';
    protected $primaryKey = 'id_fakultas';
    public $timestamps = true;
}
