<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NovaMenuMenuItem extends Model
{
    use HasFactory;

    protected $table = 'nova_menu_menu_items';

    protected $fillable = ['menu_id', 'name', 'locale', 'class', 'value', 'target', 'data', 'parent_id', 'order', 'order'];
}
