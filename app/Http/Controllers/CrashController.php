<?php

namespace App\Http\Controllers;

use App\Help\CrashHelp;
use App\Http\Requests\CrashRequest;
use App\Models\Admin;
use App\Models\Crash;
use Illuminate\Http\Request;

class CrashController extends Controller
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
        return view('super.crash', [
            'c_check'=>true,
            'crash'=> new Crash(),
            'action'=>route('crash.store'),
            'method'=>'post',
            'check'=>false,
            'btn_text'=>'Submit',
            'crashes'=>CrashHelp::crashes(),
            'i'=>1,
            'admins'=>Admin::all(),


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
    public function store(CrashRequest $request)
    {
        if(CrashHelp::store($request))
        {
            return back()->with('success', 'Successfully saved');
        }else{
            return back()->with('error', 'Could not be saved please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Crash  $crash
     * @return \Illuminate\Http\Response
     */
    public function show(Crash $crash)
    {
        //
        $crash1=Crash::find($crash->id);
        return view('super.crash', [
            'c_check'=>true,
            'crash'=> $crash1,
            'action'=>route('crash.update', $crash),
            'method'=>'post',
            'check'=>true,
            'btn_text'=>'Update',
            'crashes'=>CrashHelp::crashes(),
            'i'=>1,
            'admins'=>Admin::all(),
            

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Crash  $crash
     * @return \Illuminate\Http\Response
     */
    public function edit(Crash $crash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Crash  $crash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crash $crash)
    {
        if(CrashHelp::update($request, $crash))
        {
            return redirect()->route('crash.index')->with('success', 'Successfuly Updaed');
        }else{
            return back()->withInput()->with('error', 'Could not be updated please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Crash  $crash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crash $crash)
    {
        //
        if($crash->delete())
        {
            return back()->with('success', 'Successfuly deleted');
        }else{
            return back()->with('error', 'Could not be deleted please try again');
        }
    }
    public function assign(Request $request)
    {
       if(CrashHelp::assign($request))
       {
        return back()->with('success', 'Successfuly Assigned');
       }else{
        return back()->with('error', 'Could not be assigned');
       }
    }
}
