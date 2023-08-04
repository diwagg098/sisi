<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\log_activity;
use function App\Helpers\saveErrorToDatabase;

class KaryawanController extends Controller
{
    public function index() 
    {
        $data = Karyawan::all();
        return view('karyawan.index', compact('data'));
    }

    public function edit($id) {
        $data = Karyawan::where('id', $id)->first();
        return view('karyawan.edit', compact('data'));
    }

    public function update(Request $request,$id)
    {
        try{
            $data = [
                'jabatan' => $request->jabatan,
                'gaji' => $request->gaji,
                'join_date' => $request->join_date,
                'status' => $request->status
            ];

            Karyawan::where('id', $id)->update($data);
            log_activity(Auth::user()->id, 0, "success", Auth::user()->nama_user, "Update Data karyawan");

            alert()->success('success', 'Data karyawan berhasil di update');
            return redirect('/karyawan');
        }catch (Exception $e) {
            saveErrorToDatabase($e);
            alert()->error('error', 'Oops terjadi suatu kesalahan');
            return back();
        }

    
    } 
}
