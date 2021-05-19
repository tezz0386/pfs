<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Help\AdminHelp;
use Auth;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index', [
            'title'=>'pfs-admin',
            'd_check'=>true,
            'levels'=>AdminHelp::getLevels(),
        ]);
    }
}
