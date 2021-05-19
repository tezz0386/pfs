<?php

namespace App\Http\Controllers;

use App\Help\NepaliDate;
use App\Help\UserHelp;
use App\Models\Assistant;
use App\Models\Faculty;
use App\Models\Level;
use App\Models\Program;
use App\Models\Question;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    //
    public function index()
    {
        // $data = DB::table('levels')
        // ->leftjoin('assistants', 'assistants.level_id', '=', 'levels.id')
        // ->leftjoin('universities', 'universities.id', 'assistants.university_id')
        // ->leftjoin('programs', 'programs.id', 'assistants.program_id')
        // ->leftjoin('faculties', 'faculties.id', '=', 'assistants.faculty_id')
        // ->leftjoin('subject_assistants', 'assistants.id', '=', 'subject_assistants.assistant_id')
        // ->leftjoin('years', 'years.id', '=', 'subject_assistants.year_id')
        // ->leftjoin('b_c_m_s', 'b_c_m_s.subject_assistant_id', '=', 'subject_assistants.id')
        // ->select('levels.level_name', 'programs.program_name', 'universities.university_name', 'years.year_name', 'b_c_m_s.mode', 'programs.sm_form', 'b_c_m_s.year', 'publication', 'b_c_m_s.medium', 'b_c_m_s.file_name')
        // ->get();
        // return $data;
        // $nepali_date = new NepaliDate();
        // return $nepali_date->get_eng_date($lastDate1, 1, 1);
        // $contents=Assistant::with([
        //                 'subjectAssistants'=>function($query1){
        //                 $query1->with([
        //                     'bcms'=>function($query3){
        //                         $query3->where('year', '<=', $GLOBALS['y']);
        //                     },
        //                     'years'=>function($query2){
        //                         $query2->orderByDesc('year_name');
        //                     },
        //                     'subjects'
        //                 ]);
        //         }
        // ])->get();
        //         $year="";
        // foreach ($contents as $content) {
        //      $content->eng_year=$nepali_date->get_eng_date(2077, 1, 1);
        //  }
        // return $data;
        // return UserHelp::getPrograms();
        // return UserHelp::getContents2();
        // return UserHelp::getContents3();
        // echo asset('asset//file.txt');
        // $url = Storage::url('file.jpg');
        // return $url;
        // $path = Storage::path('public\1.jpg');
        // return $path;
        // return UserHelp::getContents1();
        // return USerHelp::getFaculties();
        // return UserHelp::crash();
        return view('index', [
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
    public function questions(Request $request)
    {
       if($request->fc !== null)
       {
         $faculty=Faculty::find($request->fc);
         $faculty_name=$faculty->faculty_name;
         $nebContents = UserHelp::getNebContents($request);
         // return $nebContents;
            if(count($nebContents)>0){
                return view('neb-content', [
                    'title'=>'pfs-'.$faculty_name,
                    'levels'=>UserHelp::getLevels(),
                    'universities'=>USerHelp::getUniversities(),
                    'programs'=>UserHelp::getPrograms(),
                    'faculties'=>USerHelp::getFaculties(),
                    'faculty_name'=>$faculty_name,
                    'nebContents'=>$nebContents,
                    'mode'=>$request->mode,
                    'title'=>'neb',
                     'crashes'=>UserHelp::crash(),
                ]);
            }else{
                return view('index', [
                    'title'=>'error-pfs-index',
                    'levels'=>UserHelp::getLevels(),
                    'universities'=>USerHelp::getUniversities(),
                    'programs'=>UserHelp::getPrograms(),
                    'faculties'=>USerHelp::getFaculties(),
                    'contents'=>UserHelp::getContents1(),
                    'contents2'=>UserHelp::getContents2(),
                    'contents3'=>UserHelp::getContents3(),
                    'error'=>'',
                     'crashes'=>UserHelp::crash(),
                ]);
            }
       }
       if($request->level == 1 && $request->mode==1)
       {
             // return UserHelp::getNebContents1($request->level, $request->mode);
            if(count(UserHelp::getNebContents1($request->level, $request->mode))>0){
             return view('see-content-questions', [
                'levels'=>UserHelp::getLevels(),
                'universities'=>USerHelp::getUniversities(),
                'programs'=>UserHelp::getPrograms(),
                'faculties'=>USerHelp::getFaculties(),
                'contents3'=>UserHelp::getNebContents1($request->level, $request->mode),
                'mode'=>$request->mode,
                'heading'=>'Old Question Papers',
                'title'=>'SEE Old Questions',
                 'crashes'=>UserHelp::crash(),
              ]);
            }else{
                return view('index', [
                    'title'=>'error-pfs-index',
                    'levels'=>UserHelp::getLevels(),
                    'universities'=>USerHelp::getUniversities(),
                    'programs'=>UserHelp::getPrograms(),
                    'faculties'=>USerHelp::getFaculties(),
                    'contents'=>UserHelp::getContents1(),
                    'contents2'=>UserHelp::getContents2(),
                    'contents3'=>UserHelp::getContents3(),
                    'error'=>'',
                     'crashes'=>UserHelp::crash(),
                ]);
            }
       }elseif($request->level == 1 && $request->mode == 2){
             // return UserHelp::getNebContents1($request->level, $request->mode);
            if(count(UserHelp::getNebContents1($request->level, $request->mode))>0){
             return view('see-content-questions', [
                'levels'=>UserHelp::getLevels(),
                'universities'=>USerHelp::getUniversities(),
                'programs'=>UserHelp::getPrograms(),
                'faculties'=>USerHelp::getFaculties(),
                'contents3'=>UserHelp::getNebContents1($request->level, $request->mode),
                'mode'=>$request->mode,
                'heading'=>'Notes/NBD',
                'title'=>'SEE - NBD/Notes',
                 'crashes'=>UserHelp::crash(),
              ]);
            }else{
                return view('index', [
                    'title'=>'pfs-index',
                    'levels'=>UserHelp::getLevels(),
                    'universities'=>USerHelp::getUniversities(),
                    'programs'=>UserHelp::getPrograms(),
                    'faculties'=>USerHelp::getFaculties(),
                    'contents'=>UserHelp::getContents1(),
                    'contents2'=>UserHelp::getContents2(),
                    'contents3'=>UserHelp::getContents3(),
                    'error'=>'',
                     'crashes'=>UserHelp::crash(),
                ]);
            }
       }elseif($request->level==2)
       {
          return view('neb-content-questions', [
                    'levels'=>UserHelp::getLevels(),
                    'universities'=>USerHelp::getUniversities(),
                    'programs'=>UserHelp::getPrograms(),
                    'faculties'=>USerHelp::getFaculties(),
                    'contents3'=>UserHelp::getNebContents1($request->level, $request->mode),
                    'mode'=>$request->mode,
                     'crashes'=>UserHelp::crash(),
                ]);
       }else{
        return $request;
       }
    }
    public function aboutUS()
    {
        return view('aboutus',
        [
            'levels'=>UserHelp::getLevels(),
            'universities'=>USerHelp::getUniversities(),
            'programs'=>UserHelp::getPrograms(),
            'faculties'=>USerHelp::getFaculties(),
            'contents'=>UserHelp::getContents1(),
            'contents2'=>UserHelp::getContents2(),
            'contents3'=>UserHelp::getContents3(),
            'title'=>'pfs-about',
             'crashes'=>UserHelp::crash(),

        ]

    );
    }
    public function getCrash($id)
    {
        $courseContent = USerHelp::getCourseContent($id, $course_id='');
        // return $courseContent;
         return view('crash-index', [
            'levels'=>UserHelp::getLevels(),
            'universities'=>USerHelp::getUniversities(),
            'programs'=>UserHelp::getPrograms(),
            'faculties'=>USerHelp::getFaculties(),
            'crash'=>USerHelp::getSingleCrash($id),
            'courses'=>UserHelp::getCourses($id),
            'courseContent'=>$courseContent,
            'title'=>'pfs-crash',
            'crashes'=>UserHelp::crash(),
            'checkTitle'=>'checkTitle'.$courseContent->id,
            'min'=>USerHelp::min($id),
            'max'=>USerHelp::max($id),
         ]);
    }
    public function getCrashCourse($id)
    {
            $courseContent = USerHelp::getCourseContent($crash_id='', $id);
            // return $courseContent;
            $crash_id = $courseContent->crash_id;
            // return USerHelp::getSingleCrash($crash_id);
            return view('crash-index', [
            'levels'=>UserHelp::getLevels(),
            'universities'=>USerHelp::getUniversities(),
            'programs'=>UserHelp::getPrograms(),
            'faculties'=>USerHelp::getFaculties(),
            'crash'=>USerHelp::getSingleCrash($crash_id),
            'courses'=>UserHelp::getCourses($crash_id),
            'courseContent'=>$courseContent,
            'title'=>'pfs-crash',
            'crashes'=>UserHelp::crash(),
            'checkTitle'=>'checkTitle'.$courseContent->id,
            'min'=>USerHelp::min($crash_id),
            'max'=>USerHelp::max($crash_id),

         ]);
    }
    public function nextPage($crash_id, $course_id)
    {
        $courseContent = USerHelp::getNextCourse($crash_id, $course_id);
        // return USerHelp::min($crash_id);
            // return $courseContent;
            // $crash_id = $courseContent->crash_id;
            // return USerHelp::getSingleCrash($crash_id);
            return view('crash-index', [
            'levels'=>UserHelp::getLevels(),
            'universities'=>USerHelp::getUniversities(),
            'programs'=>UserHelp::getPrograms(),
            'faculties'=>USerHelp::getFaculties(),
            'crash'=>USerHelp::getSingleCrash($crash_id),
            'courses'=>UserHelp::getCourses($crash_id),
            'courseContent'=>$courseContent,
            'title'=>'pfs-crash',
            'crashes'=>UserHelp::crash(),
            'checkTitle'=>'checkTitle'.$courseContent->id,
            'min'=>USerHelp::min($crash_id),
            'max'=>USerHelp::max($crash_id),

         ]);
    }
    public function previousPage($crash_id, $course_id)
    {
            $courseContent = USerHelp::getPreviousCourse($crash_id, $course_id);
            // return $courseContent;
            $crash_id = $courseContent->crash_id;
            // return USerHelp::getSingleCrash($crash_id);
            return view('crash-index', [
            'levels'=>UserHelp::getLevels(),
            'universities'=>USerHelp::getUniversities(),
            'programs'=>UserHelp::getPrograms(),
            'faculties'=>USerHelp::getFaculties(),
            'crash'=>USerHelp::getSingleCrash($crash_id),
            'courses'=>UserHelp::getCourses($crash_id),
            'courseContent'=>$courseContent,
            'title'=>'pfs-crash',
            'crashes'=>UserHelp::crash(),
            'checkTitle'=>'checkTitle'.$courseContent->id,
            'min'=>USerHelp::min($crash_id),
            'max'=>USerHelp::max($crash_id),

         ]);
    }
    public function getQuestionAnswer()
    {
        $questions= Question::with('answers')->paginate(10);
        // return $questions;
        return view('question-index', [
            'title'=>'pfs-question-answer',
            'levels'=>UserHelp::getLevels(),
            'universities'=>USerHelp::getUniversities(),
            'programs'=>UserHelp::getPrograms(),
            'faculties'=>USerHelp::getFaculties(),
            'contents'=>UserHelp::getContents1(),
            'contents2'=>UserHelp::getContents2(),
            'contents3'=>UserHelp::getContents3(),
            'crashes'=>UserHelp::crash(),
            'questions'=>$questions,
        ]);
    }

}
