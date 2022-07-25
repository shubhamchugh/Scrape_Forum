<?php

namespace App\Models\Flarum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlarumUsers extends Model
{
    use HasFactory;

    protected $connection = 'Flarum_mysql';

    protected $table = 'Flarum_users';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];
}
