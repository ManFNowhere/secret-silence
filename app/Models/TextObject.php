<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextObject extends Model
{
    /** @use HasFactory<\Database\Factories\TextObjectFactory> */
    use HasFactory;

    protected $guarded = ['id'];
}
