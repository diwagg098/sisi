<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(){
        $data = UserActivity::orderBy('id', 'DESC')->get();
        return view('activity.index', compact('data'));
    }
}
