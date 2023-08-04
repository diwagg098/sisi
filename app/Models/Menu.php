<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_name',
        'menu_link',
        'id_level',
        'parent_id',
        'create_by',
        'update_by',
        'delete_mark'
    ];

    public function level() {
        return $this->belongsTo(MenuLevel::class, 'id_level');
    }

    
}
