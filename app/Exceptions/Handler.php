<?php 
// app/Exceptions/Handler.php
namespace App\Exceptions;

use App\Models\ErrorApplication;
use Exception;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            $this->saveErrorToDatabase($e);
            return redirect()->back();
        });
    }

    protected function saveErrorToDatabase(Throwable $exception)
    {
        $data = [
            'user_id' => 0,
            'modules' => 'TestApp',
            'error_line' => $exception->getLine(),
            'error_message' => $exception->getMessage(),
            'controller' => $exception->getFile(),
            'function' => "",
            'status' => $exception->getCode(),
            'param' => "wadwad",
            'delete_mark' => false,
            'update_by' => "admin",
            'created_by' => "admin"
        ];
        ErrorApplication::create($data);
    }
}
