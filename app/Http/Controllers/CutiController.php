<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApproveCutiRequest;
use App\Models\Cuti;
use App\Models\Karyawan;
use Exception;
use Illuminate\Http\Request;

use function App\Helpers\saveErrorToDatabase;

class CutiController extends Controller
{
    public function index()
    {
        $data = Cuti::join('karyawan', 'karyawan.id', '=' ,'cuti.id_karyawan')
                ->join('users', 'users.id','=' ,'karyawan.user_id')
                ->select('cuti.id','users.nama_user', 'karyawan.jabatan', 'cuti.tanggal', 'cuti.reason', 'cuti.status')
                ->orderBy('cuti.id', 'DESC')
                ->get();

        return view('cuti.index', compact('data'));
    }

    public function submit_leave(Request $request)
    {
        try {
            $request->validate([
                'tanggal' => 'required|date'
            ]);


            Cuti::create([
                'id_karyawan' => session('id_karyawan'),
                'tanggal' => $request->tanggal,
                'reason' => $request->reason,
                'status' => 'PENDING'
            ]);

            alert()->success('success', 'Berhasil mengajukan cuti');
            return redirect()->back();
        }catch (Exception $e){
            saveErrorToDatabase($e);
            alert()->error('error', 'Oops terjadi suatu kesalahan');
            return redirect()->back();
        }
    }

    public function approve_leave(ApproveCutiRequest $request)
    {
        try {
            Cuti::where('id', $request->id_cuti)->update([
                'status' => $request->status
            ]);

            alert()->success('success','Cuti terupdate');
            return redirect('/cuti');
        }catch (Exception $e){
            saveErrorToDatabase($e);
            alert()->error('error', 'Oops terjadi suatu kesalahan');
            return redirect()->back();
        }
    } 
}
