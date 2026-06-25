<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'no_telp',
        'email',
        'alamat',
        'latitude',
        'longitude',
        'map',
    ];
}
