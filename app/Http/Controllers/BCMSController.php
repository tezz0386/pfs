<?php

namespace App\Http\Controllers;

use App\Help\AdminHelp;
use App\Help\NepaliDate;
use App\Models\BCMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BCMSController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // return AdminHelp::universitySubjects();
        return view('admin/level-bc-ms', [
            'levels'=>AdminHelp::getLevels(),
            'universitySubjects'=>AdminHelp::universitySubjects($request->id),
            'n'=>1,
            'title'=>'Content-upload',
            'level_id'=>$request->id,

            
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
    public function store(Request $request)
    {
        //
        // return $request;
        if($request->mode == 1 || $request->mode ==2)
        {
            $this->validate($request, [
                'file_name' => 'required|max:10000|mimes:pdf',
                'year'=>'required'
            ]);
        }elseif($request->mode ==3)
        {
            $this->validate($request, [
                'file_name' => 'required|max:10000|mimes:pdf',
                'year'=>'required',
                'edition'=>'required',
                'publication'=>'required',
            ]);
        }
        if(AdminHelp::checkContent($request->assistant_id, $request->mode, $request->year, $request->medium))
        {
            if(AdminHelp::contentStore($request))
            {
            return back()->with('success', 'Successfully Uploaded');
            }else{
            return back()->with('error', 'Could not be uploaded please try again');
            }
        }else{
            return back()->with('error', 'Could not be upload again please delete first and try again');
        }
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
     * Display the specified resource.
     *
     * @param  \App\Models\BCMS  $bCMS
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $subject_name="";
        $assistant_id="";
        $data=AdminHelp::getShow($id);
        if(count($data)>0)
        {
            foreach ($data as $datum) {
                $subject_name=$datum->subject_name;
                $assistant_id=$datum->id;
            }
        }
        return view('admin.bc-content-upload', [
            'title'=>'Upload Content-'.$subject_name,
            'levels'=>AdminHelp::getLevels(),
            'details'=>$data,
            'assistant_id'=>$assistant_id,
            'contents'=>AdminHelp::getContents($id),
            'n'=>1,
            'mode'=>0,
            'last_date'=>$this->lastDate(),
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BCMS  $bCMS
     * @return \Illuminate\Http\Response
     */
    public function edit(BCMS $bCMS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BCMS  $bCMS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BCMS $bCMS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BCMS  $bCMS
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $bCMS=BCMS::find($id);
        $path = parse_url($bCMS->file_name);
        $myPath="\asset\bc-ms\\";
        if (File::delete(public_path($myPath.$path['path']))) {  
            if($bCMS->delete())
            {
            return back()->with('success', 'Successfully Deleted');
            }else{
            return back()->with('error', 'Could not be deleted please try again');
            }
        }  
        else{  
             return back()->with('error', 'Could not be deleted please try again');
        }
    }
    public function search(Request $request)
    {
        $data=AdminHelp::getContent($request);
        echo json_encode($data);
    }
    public function list(Request $request, $mode)
    {
        if($mode==0)
        {
            return redirect()->route('BCorMS.upload', $request->assistant_id);
        }
        $subject_name="";
        $assistant_id="";
        $data=AdminHelp::getShow($request->assistant_id);
        if(count($data)>0)
        {
            foreach ($data as $datum) {
                $subject_name=$datum->subject_name;
                $assistant_id=$datum->id;
            }
        }
        return view('admin.bc-content-upload', [
            'title'=>'Upload Content-'.$subject_name,
            'levels'=>AdminHelp::getLevels(),
            'details'=>$data,
            'assistant_id'=>$assistant_id,
            'contents'=>AdminHelp::getContents1($request, $mode),
            'n'=>1,
            'mode'=>$mode,
            'last_date'=>$this->lastDate(),
            
        ]);
    }
    public function searchContents(Request $request)
    {
        $data=AdminHelp::searchContents($request);
        return json_encode($data);
    }
}
