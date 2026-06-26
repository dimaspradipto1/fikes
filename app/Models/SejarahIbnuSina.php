<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SejarahIbnuSina extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'url_photo',
        'url_video',
        'deskripsi',
    ];
}
