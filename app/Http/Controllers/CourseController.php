<?php

namespace App\Http\Controllers;

use App\Help\AdminHelp;
use App\Models\Course;
use App\Models\Crash;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index($id)
    {
    	return view('admin.crash-index', 
    		[
    			'levels'=>AdminHelp::getLevels(),
    			'courses'=>AdminHelp::getCourse($id),
    		]);
    }
    public function getAdd($id)
    {
        // return AdminHelp::getCrash($id);
        $img = Crash::select('crash_image', 'id', 'publish')->where('id', $id)->first();
    	return view('admin.course-add', ['courseContent'=>AdminHelp::getCrash($id), 'image_link'=>$img, 'levels'=>AdminHelp::getLevels(),]);
    }
    public function postAdd(Request $request, $id)
    {
        if(AdminHelp::postAdd($request, $id))
        {
            return back()->with('success', 'Successfully Updated');
        }
    }
    public function publish($id)
    {
        $crash = Crash::find($id);
        $crash->publish=1;
        if($crash->save()){
            return back()->with('success', 'Successfully Published');
        }
    }
    public function revert($id)
    {
        $crash = Crash::find($id);
        $crash->publish=0;
        if($crash->save()){
            return back()->with('success', 'Successfully Published');
        }
    }
    public function getAll($id)
    {
        // return AdminHelp::getAll($id);
        $crash = Crash::select('id', 'crash_name', 'crash_image')->where('id', $id)->first();
       return view('admin.course-all', [
            'courses'=>AdminHelp::getAll($id), 
            'crash'=>$crash,
            'levels'=>AdminHelp::getLevels(),
       ]);
    }
    public function read($id)
    {
        $course = Course::find($id);
        $crash = Crash::select('crash_name', 'crash_image')->where('id', $course->crash_id)->first();
        // return $crash;
        return view('admin.course-content-read',[
            'crash'=>$crash,
            'course'=>$course,
            'levels'=>AdminHelp::getLevels(),
        ]);
    }
    public function edit($id)
    {
        $course=Course::find($id);
        return view('admin.course-edit', [
            'course'=>$course,
            'levels'=>AdminHelp::getLevels(),
        ]);
    }
    public function editPost($id, Request $request)
    {
        if(AdminHelp::editCoursePost($id, $request))
        {
            return back()->with('success', 'Successfully Updated');
        }else{
             return back()->with('error', 'Could not be Updated, please try again');
        }
    }
}
