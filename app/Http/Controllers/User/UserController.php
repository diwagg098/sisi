<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddUserRequest;
use App\Models\Karyawan;
use App\Models\Menu;
use App\Models\MenuLevel;
use App\Models\MenuUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function App\Helpers\log_activity;
use function App\Helpers\saveErrorToDatabase;

class UserController extends Controller
{
    
    public function user_view(){
        $data = User::where('delete_mark', false)->get();
        return view('users.index', compact('data'));
    }

    public function add_user_view() {
        $data['roles'] = MenuLevel::all();
        $data['menus'] = Menu::where('delete_mark', false)->get();
        return view('users.add-user', $data);
    }

    public function edit_access_view($id) {
        $data['user'] = User::find($id);
        $data['menu'] = Menu::where('delete_mark', false)->get();
        $data['user_menu'] = MenuUser::where('user_id', $id)->get();
        return view('users.edit-access', $data);
    }

    public function show($id) {
        $data['user'] = User::find($id);
        $data['roles'] = MenuLevel::all();
        $data['menus'] = Menu::where('delete_mark', false)->get();
        $data['menu_user'] = MenuUser::where('user_id', $id)->get();
        return view('users.edit', $data);
    }
    public function add_user(AddUserRequest $request){
        try {
            DB::beginTransaction();
            $data_user = [
                "nama_user" => $request->nama_user,
                "email" => $request->email,
                'username' => $request->username,
                'no_hp' => $request->no_hp,
                'wa' => $request->wa,
                'pin' => $request->pin,
                'delete_mark' => false,
                'password' => Hash::make($request->password),
                'status_user' => 'active',
                'create_by' => Auth::user()->nama_user
            ];

            $user_id = DB::table('users')->insertGetId($data_user);

            // add karyawan table
            $data_karyawan = [
                "user_id" => $user_id,
                "jabatan" => $request->jabatan,
                "join_date" => $request->join_date,
                "gaji" => $request->gaji,
                "status" => $request->status
            ];

            Karyawan::create($data_karyawan);
            
            if (count($request->menus) < 0) {
                alert()->error('warning', 'Silahkan pilih menu akses');
                return redirect()->back();
            }
            for ($i=0; $i < count($request->menus); $i++) { 
                DB::table('menu_users')->insert([
                    'user_id' => $user_id,
                    'menu_id' => $request->menus[$i],
                    'created_at' => now()
                ]);
            }

            log_activity(Auth()->user()->id, 0, 'success', Auth()->user()->nama_user, "add new user");
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
            saveErrorToDatabase($e);
            alert()->error('error', 'Oops terjadi suatu kesalahan');
            return redirect()->back();
        }

        alert()->success('success', 'data user berhasil ditambahkan');
        return redirect('/users');
    }

    public function update(Request $request,$id){
        try {
            DB::beginTransaction();
            $data_user = [
                "nama_user" => $request->name,
                "email" => $request->email,
                'username' => $request->username,
                'no_hp' => $request->no_hp,
                'wa' => $request->wa,
                'delete_mark' => false,
                'status_user' => $request->status
            ];

            User::where('id', $id)->update($data_user);

            log_activity(Auth()->user()->id, 0, 'success', Auth()->user()->nama_user, "add update user");
            alert()->success('success', 'data user berhasil diedit');
            return redirect('/users');
        }catch(Exception $e){
            DB::rollBack();
            saveErrorToDatabase($e);
            alert()->error('error', 'Oops terjadi suatu kesalahan');
            return redirect()->back();
        }
    }
    public function edit_access(Request $request, $id){
        try {
            for ($i=0; $i < count($request->cb); $i++) { 
                // check duplicate value menu
                $menuExist = MenuUser::where('user_id', $id)->where('menu_id', $request->cb[$i])->first();
                if (!$menuExist) {
                    MenuUser::create([
                        'user_id' => $id,
                        'menu_id' => $request->cb[$i]
                    ]);
                }
            }
            log_activity(Auth()->user()->id, 0, 'success', Auth()->user()->nama_user, "edit access user");
            alert()->success('success', 'data access user berhasil diedit');
            return redirect('/users');
        }catch (Exception $e){
            saveErrorToDatabase($e);
            alert()->error('error', 'Oops terjadi suatu kesalahan');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            User::where('id', $id)->update([
                'delete_mark' => true
            ]);

            log_activity(Auth()->user()->id, 0, 'success', Auth()->user()->nama_user, "delete user");
            alert()->success('success', 'data access user berhasil diedit');
            return redirect('/users');
        }catch(Exception $e) {
            saveErrorToDatabase($e);
            alert()->error('error', 'Oops terjadi suatu kesalahan');
            return redirect()->back();
        }
    }
}
