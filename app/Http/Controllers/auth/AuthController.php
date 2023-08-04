<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Menu;
use App\Models\MenuUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login_view(){
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $data = MenuUser::where('user_id', '=',Auth()->user()->id)
                                ->where('menus.delete_mark', false)
                                ->select('menu_levels.level', 'menus.id_level')
                                ->join('menus', 'menus.id', '=','menu_users.menu_id')
                                ->join('menu_levels', 'menu_levels.id', '=', 'menus.id_level')
                                ->groupBy('menu_levels.level', 'menus.id_level')
                                ->get();

            $access = [];
            foreach ($data as $row) {
                $menu = MenuUser::where('user_id', '=',Auth()->user()->id)
                            ->where('menus.id_level','=', $row->id_level)
                            ->where('menus.delete_mark', false)
                            ->select('menus.menu_name','menus.menu_link', 'menus.id_level')
                            ->join('menus', 'menus.id', '=','menu_users.menu_id')
                            ->join('menu_levels', 'menu_levels.id', '=', 'menus.id_level')
                            ->get();

                $access_detail = [
                    "level" => $row->level,
                    "level_id" => $row->id_level,
                    "detail" => $menu
                ];

                array_push($access, $access_detail);
            }

            $karyawan = Karyawan::where('user_id', Auth::user()->id)->first();

            $request->session()->put([
                'user' => Auth::user(),
                'access' => $access ,
                'id_karyawan' => $karyawan->id
            ]);


            return redirect('/');
        }

        alert()->error('error', 'Email atau password salah');
        return back();
    }

    public function logout(){
        Auth::logout();
        return redirect('auth/login');
    }
}
