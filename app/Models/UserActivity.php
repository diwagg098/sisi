<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'menu_id', 'delete_mark', 'created_by', 'update_by', 'description', 'status'
    ];
}
