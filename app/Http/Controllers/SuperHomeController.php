<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:super');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('super.index', ['title'=>'pfs-super', 'd_check'=>true]);
    }
}
