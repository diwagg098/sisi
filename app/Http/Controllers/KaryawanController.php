<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAbsensiKaryawan;
use App\Http\Requests\AddSppdRequest;
use App\Models\Cuti;
use App\Models\Karyawan;
use App\Models\Presensi;
use App\Models\Sppd;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function App\Helpers\log_activity;
use function App\Helpers\saveErrorToDatabase;


class KaryawanController extends Controller
{
    public $id_karyawan;

    public function __construct()
    {
        $this->id_karyawan = session('id_karyawan');
    }

    public function index() 
    {
        $data = Karyawan::all();
        return view('karyawan.index', compact('data'));
    }

    public function edit($id) {
        $data = Karyawan::where('id', $id)->first();
        return view('karyawan.edit', compact('data'));
    }

    public function presensi_view()
    {
        $id_karyawan = session('id_karyawan');
        $data['karyawan'] = Karyawan::where('id', $id_karyawan)->first();
        $data['absensi'] = Presensi::where('id_karyawan', $id_karyawan)->orderBy('tanggal', 'DESC')->limit(30)->get();
        $data['leaves'] = Cuti::where('id_karyawan', $id_karyawan)->limit(10)->get();

        return view('karyawan.presensi-karyawan',$data);
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

    public function ambil_absen(AddAbsensiKaryawan $request)
    {
        try {
            $check_date = Presensi::where('id_karyawan', $request->id_karyawan)
                            ->where('tanggal', $request->tanggal)
                            ->first();
            
            if ($check_date) {
                alert()->warning('anda sudah mengambil absen hari ini :(');
                return back();
            }

            $result = $this->convertTime(Carbon::now()->format('Y-m-d H:i:s'));
            
            Presensi::create([
                "id_karyawan" => $request->id_karyawan,
                "tanggal" => $request->tanggal,
                "status" => $result['status'],
                "waktu_keterlambatan" => $result['keterlambatan'],
                "denda" => $result['denda']
            ]);
            log_activity(Auth::user()->id, 0, "success", Auth::user()->nama_user, "Mengambil Absen");
            alert()->success('success', 'Absensi berhasil');
            return back();

        }catch (Exception $e) {
            saveErrorToDatabase($e);
            alert()->error('error', 'Oops terjadi suatu kesalahan');
            return back();
        }
    }

    public function gaji() 
    {
        $karyawan = Karyawan::all();

        $data = [];
        foreach($karyawan as $item) {
            $denda = Presensi::where('id_karyawan', $item->id)
                    ->whereMonth('tanggal', date('m'))
                    ->sum('denda');
            $value = [
                "nama_user" => $item->user->nama_user,
                "gaji" => $item->gaji,
                "jabatan" => $item->jabatan,
                "denda" => $denda
            ];

            array_push($data, $value);
        }
        return view('karyawan.gaji', compact('data'));
    }

    protected function convertTime($datetime)
    {
        $datetimenow = Carbon::today()->setHour(8)->format('Y-m-d H:i:s');
    
        $datetime1 = Carbon::parse($datetime);
        $datetime2 = Carbon::parse($datetimenow);

        if($datetime > $datetimenow) {
            $diff = $datetime1->diff($datetime2);
            $hour = $diff->format('%h');
            
            $denda = 10000 * intval($hour);
            return [
                "status" => "terlambat",
                "datetime" => $datetime,
                "now" => $datetimenow,
                "keterlambatan" => $diff->format('%h jam, %i menit, %s detik'),
                "denda" => $denda
            ];
        } else {
            return [
                "status" => 'on time',
                "datetime" => $datetime,
                "now" => $datetimenow,
                "keterlambatan" => "",
                "denda" => 0 
            ];
        }
    }

    public function uploadSppd_view(){
        $data = Sppd::all();
        return view('karyawan.sppd', compact('data'));
    }

    public function uploadSppd(AddSppdRequest $request) {
        try {
            if ($request->hasFile('file')) {
                $path = $this->storeUploadedFile($request->file('file'));
                $location = storage_path('/app/public/' . $path);
            }

            Sppd::create([
                'nama_file' => $request->nama_file,
                'url' => $path
            ]);

            alert()->success('succes','File berhasil di upload');
            return redirect()->back();
        }catch (Exception $e) {
            saveErrorToDatabase($e);
            alert()->error('error', 'Oops terjadi suatu kesalahan');
            return back();
        }

        
    }
    private function storeUploadedFile($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('uploads', $filename, 'public');
    }
}
