<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    /** @use HasFactory<\Database\Factories\SongsFactory> */
    use HasFactory;

    protected $guarded = ['id'];
}
