<?php

namespace App\Http\Controllers\Menu;


use App\Http\Controllers\Controller;
use App\Http\Requests\AddMenuRequest;
use App\Models\Menu;
use App\Models\MenuLevel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\log_activity;
use function App\Helpers\saveErrorToDatabase;

class MenuController extends Controller
{
    public function index()
    {
        $data = Menu::where('delete_mark', false)->get();
        return view('menu.index', compact('data'));
    }

    public function create()
    {
        $data = MenuLevel::all();
        return view('menu.create', compact('data'));
    }

    public function store(AddMenuRequest $request)
    {
        try {
            $data = [
                'id_level' => intval($request->id_level),
                'menu_name' => $request->menu_name,
                'menu_link' => $request->menu_link,
                'menu_icon' => $request->menu_icon,
                'create_by' => Auth::user()->nama_user
            ];
            
            Menu::create($data);

            log_activity(Auth()->user()->id, 0, 'success', Auth()->user()->nama_user, "add new menu access");
            alert()->success('success','Menu berhasil ditambahkan');
            return redirect('/menu');
        }catch (Exception $e) {
            saveErrorToDatabase($e);
            alert()->error('error', 'Oops terjadi suatu kesalahan');
            return back();
        }
    }

    public function show($id)
    {
        $data = Menu::where('delete_mark', false)->where('id', $id)->first();
        return view('menu.show', compact('data'));
    }

    public function edit($id)
    {
        $data['menu'] = Menu::where('delete_mark', false)->where('id',$id)->first();
        $data['level'] = MenuLevel::all();
        return view('menu.edit', $data);
    }

    public function update(AddMenuRequest $request, $id)
    {
        try {
            $data = [
                'id_level' => $request->id_level,
                'menu_name' => $request->menu_name,
                'menu_link' => $request->menu_link,
                'menu_icon' => $request->menu_icon,
                'update_by' => Auth::user()->nama_user
            ];

            Menu::where('id', $id)->update($data);
            log_activity(Auth()->user()->id, 0, 'success', Auth()->user()->nama_user, "update menu access");
            alert()->success('success', 'Menu berhasil di edit');
            return redirect('/menu');
        } catch(Exception $e) {
            saveErrorToDatabase($e);
            alert()->error('Error', 'Oops terjadi suatu kesalahan');
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            Menu::where('id', $id)->update(['delete_mark' => true]);
            alert()->success('success','Menu berhasil dihapus');
            return redirect('menu');
        }catch (Exception $e){
            saveErrorToDatabase($e);
            alert()->error('error', 'Oops terjadi suatu kesalahan');
            return back();
        }
    }
}
