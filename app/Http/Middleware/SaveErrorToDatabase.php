<?php

namespace App\Http\Middleware;

use App\Models\ErrorApplication;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaveErrorToDatabase
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (\Throwable $exception) {
            $this->saveErrorToDatabase($exception);

            // Berikan respons yang sesuai tanpa menampilkan halaman error standar
            return response()->json(['message' => 'Terjadi kesalahan dalam sistem.'], 500);
        }
    }

    protected function saveErrorToDatabase(\Throwable $exception)
    {
        // Implementasi logika penyimpanan error ke dalam database seperti sebelumnya
    }
}
