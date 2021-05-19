<?php

namespace App\Http\Controllers;

use App\Help\FacultyHelp;
use App\Http\Requests\FacultyRequest;
use App\Http\Requests\FacultyUpdateRequest;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('super.faculty',[
            'f_check'=>true,
            'faculties'=>FacultyHelp::faculties(),
            'action'=>route('faculty.store'),
            'method'=>'post',
            'check'=>false,
            'faculty'=>new Faculty(),
            'btn_text'=>'Save',
            'i'=>1,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacultyRequest $request)
    {
        //
        if(FacultyHelp::store($request))
        {
            return redirect()->route('faculty.index')->with('success', 'Successfully Saved');
        }else{
            return back()->withInput()->with('error', 'Could not be saved please try again');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        //
         return view('super.faculty',[
            'f_check'=>true,
            'faculties'=>FacultyHelp::faculties(),
            'action'=>route('faculty.update', $faculty),
            'method'=>'post',
            'check'=>true,
            'faculty'=>$faculty,
            'btn_text'=>'Update',
            'i'=>1,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $faculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(FacultyUpdateRequest $request, Faculty $faculty)
    {
        //
         if(FacultyHelp::update($request, $faculty))
        {
            return redirect()->route('faculty.index')->with('success', 'Successfully Updated');
        }else{
            return back()->withInput()->with('error', 'Could not be update please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculty $faculty)
    {
        //
    }
}
