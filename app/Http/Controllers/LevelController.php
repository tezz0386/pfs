<?php

namespace App\Http\Controllers;

use App\Help\FacultyHelp;
use App\Help\LevelHelp;
use App\Help\ProgramHelp;
use App\Help\SubjectHelp;
use App\Help\UniversityHelp;
use App\Http\Requests\LevelRequest;
use App\Http\Requests\LevelUpdateRequest;
use App\Models\Admin;
use App\Models\Assistant;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
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
        $level=new Level();
        return view('super.level', [
            'levels'=>LevelHelp::levels(),
            'l_check'=>true,
            'level'=>$level,
            'btn_text'=>'Save',
            'action'=>route('level.store'),
            'method'=>'post',
            'check'=>false,
            'i'=>1,
        ]);
    }
    public function getProgram(Level $level)
    {
        $all = LevelHelp::getProgram();
        if($level->id>2)
        {
           return view('super.level-program', [
                'level'=>$level,
                'universities'=>UniversityHelp::universities(),
                'programs'=>ProgramHelp::programs(),
                'faculties'=>FacultyHelp::faculties(),
                'all'=>$all,
                'i'=>1,
                'l_check'=>true,

           ]);
        }else{
           if($level->id==1)
           {
            return view('super.neb-see-subject', [
                'level'=>$level,
                'subjects'=>SubjectHelp::getSubjects(),
                'l_check'=>true,
                'seeOrNebSubjects'=>LevelHelp::seeOrNebSubjects(1),
                'i'=>1,
                'admins'=>Admin::all(),
            ]);
           }elseif($level->id==2)
           {
            return view('super.neb-see-subject', [
                'level'=>$level,
                'subjects'=>SubjectHelp::getSubjects(),
                'class_check'=>true,
                'l_check'=>true,
                'faculties'=>FacultyHelp::faculties(),
                'seeOrNebSubjects'=>LevelHelp::seeOrNebSubjects(2),
                'i'=>1,
                'admins'=>Admin::all(),
            ]);
           }else{
            return back()->with('error', 'Could not be managed for this level');
           }
        }
    }
    public function postProgram(Request $request, Level $level)
    {
        // return $request;
        $this->validate($request, [
            'university_id'=>'required',
            'program_id'=>'required',
            'faculty_id'=>'required',
        ]);
        $all=Assistant::where('university_id', $request->university_id)->where('program_id',  $request->program_id)->first();
        if($all !== null)
        {
            return back()->with('error', 'Could not be add this program again to this university');
        }
        if(LevelHelp::postProgram($request, $level))
        {
            return back()->with('success', 'Successfully added');
        }else{
            return back()->withInput()->with('error', 'Could not be added now please try again');
        }
    }
    public function destroyProgram($id)
    {
        $assistant=Assistant::find($id);
        if($assistant->delete())
        {
            return back()->with('success', 'Successfully Deleted');
        }else{
            return back()->with('error', 'Could not be deleted');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LevelRequest $request)
    {
        //
         $validated = $request->validated();
         if(LevelHelp::store($request))
         {
            return redirect()->route('level.index')->with('success', 'Successfully Saved');
         }else{
            return redirect()->route('level.index')->with('error', 'Couldnot saved please try again');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        //
        return view('super.level', [
            'levels'=>LevelHelp::levels(),
            'l_check'=>true,
            'level'=>$level,
            'btn_text'=>'Update',
            'action'=>route('level.update', $level),
            'method'=>'post',
            'check'=>true,
            'i'=>1
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(LevelUpdateRequest $request, Level $level)
    {
        //
        if(LevelHelp::update($request, $level))
        {
            return redirect()->route('level.index')->with('success', 'Successfully Updated');
        }else{
            return back()->withInput()->with('error', 'Could not be updated please try again');
        }
    }
}
