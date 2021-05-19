<?php

namespace App\Http\Controllers;

use App\Help\AdminHelp;
use App\Help\NepaliDate;
use App\Models\Admin;
use App\Models\SeeNeb;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SeeNebController extends Controller
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
    public function lastDate()
    {
        $nepali_date = new NepaliDate();
        $year_en = date("Y",time());
        $month_en = date("m",time());
        $day_en = date("d",time());
        $date_ne = $nepali_date->get_nepali_date($year_en, $month_en, $day_en);
        return $date_ne['y'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // return AdminHelp::getOldQuestions(1);
        // $nepali_date = new NepaliDate();
        // $year_en = date("Y",time());
        // $month_en = date("m",time());
        // $day_en = date("d",time());
        // $date_ne = $nepali_date->get_nepali_date($year_en, $month_en, $day_en);
        // return $date_ne;
        $value="";
        $olds="";
        if($request->id==1)
        {
            $olds=AdminHelp::getOldQuestions(1);
            $value="NBD";
        }else{
            $olds=AdminHelp::getOldQuestions(2);
            $value="Guess Paper";
        }
        // return $olds;
        return view('admin.SEEorNEB', [
            's_check'=>true,
            'levels'=>AdminHelp::getLevels(),
            'subjects'=>AdminHelp::getSEEorNEBSubjects($request->id),
            'value'=>$value,
            'olds'=>$olds,
            'count'=>1,
            'c'=>1,
            'level_id'=>$request->id,
            'last_date'=>$this->lastDate(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return $request;
        if($request->mode==1)
        {
            $this->validate($request, [
                'subject_name'=>'required',
                'year'=>'required',
                'file' => 'required|max:10000|mimes:pdf'
            ]);
            if(!AdminHelp::check1($request->year, $request->subject_name, $request->is_regular))
            {
               return back()->with('error', 'Could not be upload question paper for this subject');
            }
        }else{
            $this->validate($request, [
                'subject_name'=>'required',
                'year'=>'required',
                'file' => 'required|max:10000|mimes:pdf',
                'edition'=>'required',
                'publication'=>'required',
            ]);
            if(!AdminHelp::check2($request->year, $request->subject_name, $request->edition, $request->publication, $request->medium))
            {
                return back()->with('error', 'Could not be upload NBD/Guess Paper for this subject');
            }
        }
        if(AdminHelp::nbdQStore($request))
        {
            return back()->with('success', 'Successfully uploaded');
        }else{
            return back()->with('error', 'Could not be uploaded please try again');
        }
    }
    public function destroy($id)
    {
        //
        $seeNeb=SeeNeb::find($id);
        $path = parse_url($seeNeb->file_name);
        $myPath="\asset\see-neb\\";
        if(File::delete(public_path($myPath.$path['path'])))
        {
            if($seeNeb->delete())
             {
                return back()->with('success', 'Successfully Deleted');
             }else{
            return back()->with('error', 'Could not be deleted please try again');
            }
        }else{
            return back()->with('error', 'Could not be deleted please try again');
        }
    }
    public function show(Request $request)
    {
            $data=AdminHelp::getSearch($request);

            echo json_encode($data);
    }
    public function search2(Request $request)
    {
        // echo "string";
            $data=AdminHelp::getSearch2($request);

            echo json_encode($data);
    }
}
