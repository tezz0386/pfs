<?php

namespace App\Http\Controllers;

use App\Help\UniversityHelp;
use App\Http\Requests\UniversityRequest;
use App\Http\Requests\UniversityUpdateRequest;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
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
          return view('super.university',[
                'universities'=>UniversityHelp::universities(),
                'u_check'=>true,
                'i'=>1,
                'action'=>route('university.store'),
                'method'=>'post',
                'check'=>false,
                'university'=>new University(),
                'btn_text'=>'Save',

          ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UniversityRequest $request)
    {
        //
        $validated = $request->validated();
        if(UniversityHelp::store($request))
        {
            return back()->with('success', 'Successfully Saved');
        }else{
            return back()->withInput()->with('error', 'Could not be saved');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        //
        return view('super.university',[
                'universities'=>UniversityHelp::universities(),
                'u_check'=>true,
                'i'=>1,
                'action'=>route('university.update', $university),
                'method'=>'post',
                'check'=>false,
                'btn_text'=>'Update',
                'check'=>true,
                'university'=>$university,

          ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(UniversityUpdateRequest $request, University $university)
    {
        //
         if(UniversityHelp::update($request, $university))
         {
            return redirect()->route('university.index')->with('success', 'Successfully Updated');
         }else{
            return back()->withInput()->with('error', 'Could not be update please try again');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        //
         $university->status=0;
         if($university->save())
         {
            return back()->with('success', 'Successfully Trashed');
         }else{
            return back()->with('error', 'Could not be success please try again');
         }
    }
    public function trash()
    {
       return view('super.university-trash', [
            'universities'=>UniversityHelp::trash(),
            'u_check'=>true,
            'i'=>1
        ]);
    }
    public function restore(University $university)
    {
          $university->status=1;
         if($university->save())
         {
            return back()->with('success', 'Successfully Restored');
         }else{
            return back()->with('error', 'Could not be success please try again');
         }
    }
    public function delete(University $university)
    {
        if($university->delete())
         {
            return back()->with('success', 'Successfully Deleted');
         }else{
            return back()->with('error', 'Could not be success please try again');
         }
    }
}
