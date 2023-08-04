<?php 

namespace App\Helpers;

use App\Models\User;
use App\Models\UserActivity;

function log_activity($user_id, $menu_id, $status, $create_by, $description)
{
    UserActivity::create([
        'user_id' => $user_id,
        'menu_id' => $menu_id,
        'status' => $status,
        'created_by' => $create_by,
        'description' => $description,
        'update_by' => $create_by
    ]);
}