<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceUrl extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];
}
