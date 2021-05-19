<?php

namespace App\Http\Controllers;

use App\Help\ProgramHelp;
use App\Http\Requests\ProgramRequest;
use App\Http\Requests\ProgramUpdateRequest;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
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
        return view('super.program',[
            'p_check'=>true,
            'programs'=>ProgramHelp::programs(),
            'action'=>route('program.store'),
            'method'=>'post',
            'check'=>false,
            'program'=>new Program(),
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
    public function store(ProgramRequest $request)
    {
        //
        if(ProgramHelp::store($request))
        {
            return redirect()->route('program.index')->with('success', 'Successfully Saved');
        }else{
            return back()->withInput()->with('error', 'Could not be saved please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
        return view('super.program',[
            'p_check'=>true,
            'programs'=>ProgramHelp::programs(),
            'action'=>route('program.update', $program),
            'method'=>'post',
            'check'=>true,
            'program'=>$program,
            'btn_text'=>'Update',
            'i'=>1,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramUpdateRequest $request, Program $program)
    {
        //
        if(ProgramHelp::update($request, $program))
        {
            return redirect()->route('program.index')->with('success', 'Successfully Updated');
        }else{
            return back()->withInput()->with('error', 'Could not be Updated please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        //
    }
}
