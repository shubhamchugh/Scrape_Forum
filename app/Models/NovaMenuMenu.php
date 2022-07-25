<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NovaMenuMenu extends Model
{
    use HasFactory;

    protected $table = 'nova_menu_menus';

    protected $fillable = ['name', 'slug', 'lname', 'email', 'phone', 'msg'];
}
