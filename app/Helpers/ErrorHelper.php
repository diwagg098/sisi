<?php 

namespace App\Helpers;

use App\Models\ErrorApplication;

function saveErrorToDatabase(\Exception $exception)
{
    // Simpan data error ke dalam tabel ErrorApplication
    ErrorApplication::create([
        'user_id' => 0,
        'modules' => 'TestApp',
        'error_line' => $exception->getLine(),
        'error_message' => $exception->getMessage(),
        'controller' => $exception->getFile(),
        'status' => $exception->getCode(),
        'function' => '-',
        'param' => '-',
        'delete_mark' => false,
        'update_by' => "admin",
        'created_by' => "admin",
    ]);
}
