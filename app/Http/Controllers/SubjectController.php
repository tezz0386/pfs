<?php

namespace App\Http\Controllers;

use App\Help\SubjectHelp;
use App\Http\Requests\SubjectRequest;
use App\Http\Requests\SubjectUpdateRequest;
use App\Models\Admin;
use App\Models\Assistant;
use App\Models\SeeNebAssistant;
use App\Models\Subject;
use App\Models\SubjectAssistant;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
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
        return view('super.subject', [
                'subjects'=>SubjectHelp::subjects(),
                's_check'=>true,
                'subject'=> new Subject(),
                'method'=>'post',
                'check'=>false,
                'action'=>route('subject.store'),
                'i'=>1,
                'btn_text'=>'Save',

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
    public function store(SubjectRequest $request)
    {
        //
        if(SubjectHelp::store($request))
        {
            return redirect()->route('subject.index')->with('success', 'Successfully Saved');
        }else{
            return back()->withIntpu()->with('error', 'Could not be  Saved, please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
        return view('super.subject', [
                'subjects'=>SubjectHelp::subjects(),
                's_check'=>true,
                'subject'=> $subject,
                'method'=>'post',
                'check'=>true,
                'action'=>route('subject.update', $subject),
                'i'=>1,
                'btn_text'=>'Update',


        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectUpdateRequest $request, Subject $subject)
    {
        //
        if(SubjectHelp::update($request, $subject))
        {
            return redirect()->route('subject.index')->with('success', 'Successfully Updated');
        }else{
            return back()->withIntpu()->with('error', 'Could not be  Updated, please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }
    public function getSubProgram($id)
    {
       $subjectAssistant=SubjectHelp::subjectAssistant($id);
       $assistant=Assistant::find($id);
       return view('super.program-subject', [
            'subjects'=>SubjectHelp::subjects(),
            'years'=>Year::select('year_name', 'id')->get(),
            'faculty_name'=>SubjectHelp::facultyName($assistant->faculty_id),
            'program_name'=>SubjectHelp::programName($assistant->program_id),
            'level_name'=>SubjectHelp::levelName($assistant->level_id),
            'university_name'=>SubjectHelp::universityName($assistant->university_id),
            'l_check'=>true,
            'ways'=>$assistant->ways,
            'assistant_id'=>$id,
            'subjectAssistants'=>$subjectAssistant,
            'i'=>1,
            'admins'=>Admin::select('id', 'name')->get(),



       ]);
    }
    public function postSubProgram(Request $request, $id)
    {
        $this->validate($request, [
            'subject_name'=>'required',
            'subject_code'=>'required|unique:subject_assistants',
            'year_name'=>'required',
        ]);
        $check=SubjectAssistant::where('subject_id', $request->subject_name)->where('assistant_id', $id)->first();
        if($check != null)
        {
            return back()->with('error', 'This subject could not be add again to this program for this year');
        }else{
            if(SubjectHelp::postSubProgram($request, $id))
            {
                return back()->with('success', 'Successfully Added');
            }else{
                return back()->with('error', 'could not be added');
            }
        }
    }
    public function postAssignSubject(Request $request)
    {
        $sub=SubjectAssistant::find($request->subjectAssistant_id);
        $sub->assign=$request->admin_id;
        if($sub->save())
        {
            return back()->with('success', 'Succesfully Assigned');
        }else{
            return back()->with('error', 'Could not be assigned please try again');
        }
    }
    public function postNebOrSeeSubProgram(Request $request, $id)
    {
        if($id==1)
        {
            $this->validate($request, [
                'subject_code'=>'required|unique:see_neb_assistants',
                'subject_name'=>'required',
            ]);
        }else{
            $this->validate($request, [
                'subject_code'=>'required|unique:see_neb_assistants',
                'subject_name'=>'required',
                'class'=>'required',
                'faculty_name'=>'required',
            ]);
        }
        $seeNebAssistant = SeeNebAssistant::where('subject_id', $request->subject_name)->where('level_id', $id)->where('class', $request->class)->first();
        if($seeNebAssistant !== null)
        {
            return back()->with('error', 'Could not be added again this subject to this level or class');
        }
        if(SubjectHelp::postNebOrSeeSubProgram($request, $id))
        {
            return back()->with('success', 'Successfully Registereed');
        }else{
            return back()->with('error', 'Could not be registered');
        }
    }
    public function postAssignSeeOrNebSubject(Request $request)
    {
       if(SubjectHelp::assign($request))
       {
        return back()->with('success', 'Successfully Assigned');
       }else{
        return back()->with('error', 'Could not be manage please try again');
       }
    }
    public function deleteSubProgram(Request $request, $id)
    {
        if(SubjectHelp::deleteSubject($id))
        {
            return back()->with('success', 'Succfully Deleted');
        }else{
            return back()->with('error', 'Could not be deleted please try again');
        }
    }
    public function deleteSubjectSeeorNeb(Request $request, $id)
    {
        if(SubjectHelp::deleteSubjectSeeorNeb($id))
        {
            return back()->with('success', 'Succfully Deleted');
        }else{
            return back()->with('error', 'Could not be deleted please try again');
        }
    }
}
