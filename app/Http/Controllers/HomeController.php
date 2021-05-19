<?php

namespace App\Http\Controllers;

use App\Help\UserHelp;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'title'=>'pfs-index',
            'levels'=>UserHelp::getLevels(),
            'universities'=>USerHelp::getUniversities(),
            'programs'=>UserHelp::getPrograms(),
            'faculties'=>USerHelp::getFaculties(),
            'contents'=>UserHelp::getContents1(),
            'contents2'=>UserHelp::getContents2(),
            'contents3'=>UserHelp::getContents3(),
            'crashes'=>UserHelp::crash(),
        ]);
    }
}
