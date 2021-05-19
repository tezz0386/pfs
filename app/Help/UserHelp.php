<?php 
namespace App\Help;

use App\Help\NepaliDate;
use App\Models\Course;
use App\Models\Crash;
use App\Models\Faculty;
use App\Models\Level;
use App\Models\Program;
use App\Models\University;
use Illuminate\Support\Facades\DB;
/**
 * 
 */
class UserHelp
{
	public static function lastDate()
    {
        $nepali_date = new NepaliDate();
        $year_en = date("Y",time());
        $month_en = date("m",time());
        $day_en = date("d",time());
        $date_ne = $nepali_date->get_nepali_date($year_en, $month_en, $day_en);
        return $date_ne['y'];
    }
	public static function getLevels()
	{
		$levels=Level::where('id', '>', 2)->select('id', 'level_name')->get();
        return $levels;
	}
	public static function getUniversities()
	{
		$universities=University::select('universities.id', 'university_name')->get();
        return $universities;
	}
	public static function getPrograms()
	{
		$programs=Program::select('programs.id', 'assistants.level_id', 'program_name', 'sm_form', 'university_id', 'assistants.program_id', 'assistants.id as assistant_id')
                        ->join('assistants', 'assistants.program_id', '=', 'programs.id')
                        ->get();
        return $programs;
	}
	public static function getFaculties()
	{
		$faculties=Faculty::select('id','faculty_name')->get();
		return $faculties;
	}
	public static function getContents1()
	{
		        $lastDate1=USerHelp::lastDate();
                $lastDate=$lastDate1-3;
		        $contents=DB::table('subject_assistants')
                ->leftjoin('b_c_m_s', 'b_c_m_s.subject_assistant_id', '=', 'subject_assistants.id')
                ->leftjoin('subjects', 'subject_assistants.subject_id', '=', 'subjects.id')
                ->leftjoin('assistants', 'subject_assistants.assistant_id', '=', 'assistants.id')
                ->leftjoin('years', 'subject_assistants.year_id', '=', 'years.id')
                ->select('b_c_m_s.id', 'b_c_m_s.year', 'b_c_m_s.publication', 'b_c_m_s.mode', 'b_c_m_s.edition', 'b_c_m_s.medium', 'b_c_m_s.file_name', 'years.year_name', 'assistants.id as assistant_id', 'subjects.subject_name', 'assistants.ways')
                ->where('b_c_m_s.year', '>=', $lastDate)
                ->orderByDesc('years.year_name')
                ->get();
                return $contents;
	}
    public static function getContents2()
    {
        $lastDate1=USerHelp::lastDate();
        $lastDate=$lastDate1-3;
        $contents3=DB::table('subjects')
                   ->join('see_neb_assistants', 'subjects.id', '=', 'see_neb_assistants.subject_id')
                   ->join('see_nebs', 'see_neb_assistants.id', '=', 'see_nebs.seeneb_id')
                   ->join('levels', 'levels.id', '=', 'see_neb_assistants.level_id')
                   ->select('subjects.subject_name', 'see_nebs.file_name', 'see_nebs.year', 'see_nebs.mode', 'see_neb_assistants.faculty_id', 'see_nebs.id')
                   ->where('levels.id', '=', 1)
                   ->where('see_nebs.year', '>=', $lastDate)
                   ->orderByDesc('see_nebs.created_at')
                   ->get();
        return $contents3;
    }
    public static function getContents3()
    {
        $lastDate1=USerHelp::lastDate();
        $lastDate=$lastDate1-3;
        $contents2=DB::table('subjects')
                   ->join('see_neb_assistants', 'subjects.id', '=', 'see_neb_assistants.subject_id')
                   ->join('see_nebs', 'see_neb_assistants.id', '=', 'see_nebs.seeneb_id')
                   ->join('levels', 'levels.id', '=', 'see_neb_assistants.level_id')
                   ->select('subjects.subject_name', 'see_nebs.file_name', 'see_nebs.year', 'see_nebs.mode', 'see_neb_assistants.class', 'see_neb_assistants.faculty_id', 'see_nebs.id')
                   ->where('levels.id', '=', 2)
                   ->where('see_nebs.year', '>=', $lastDate)
                   ->orderByDesc('see_neb_assistants.class')
                   ->get();
        return $contents2;
    }
    public static function getNebContents($request)
    {
      $nebContents=DB::table('see_neb_assistants')
         ->join('subjects', 'subjects.id', '=', 'see_neb_assistants.subject_id')
         ->join('see_nebs', 'see_neb_assistants.id', '=', 'see_nebs.seeneb_id')
         ->where('see_nebs.mode', $request->mode)
         ->where('see_neb_assistants.faculty_id', $request->fc)
         ->where('see_neb_assistants.level_id', $request->level)
         // ->where('see_nebs.year', '>=', 2070)
         ->select('subject_name', 'subject_code', 'subject_code', 'mode', 'file_name', 'year', 'class', 'see_nebs.id')
         ->orderByDesc('see_nebs.year')
         ->simplePaginate(70);
      return $nebContents;
    }
    public static function getNebContents1($level, $mode)
    {
      $nebContents=DB::table('see_neb_assistants')
         ->join('subjects', 'subjects.id', '=', 'see_neb_assistants.subject_id')
         ->join('see_nebs', 'see_neb_assistants.id', '=', 'see_nebs.seeneb_id')
         ->where('see_nebs.mode', $mode)
         ->where('see_neb_assistants.level_id', $level)
         // ->where('see_nebs.year', '>=', 2070)
         ->select('subject_name', 'subject_code', 'subject_code', 'mode', 'file_name', 'year', 'class', 'see_nebs.id', 'see_neb_assistants.faculty_id')
         ->orderByDesc('see_nebs.year')
         ->simplePaginate(70);
      return $nebContents;
    }
    public static function crash()
    {
      return Crash::select('id', 'crash_name')->where('publish', 1)->get();
    }
    public static function getSingleCrash($id)
    {
      return $singleCrash= Crash::select('crash_name', 'crash_image', 'id')->where('id', $id)->first();;
    }
    public static function getCourses($id)
    {
      return $courses=Course::select('title', 'id')->where('crash_id', $id)->get();
    }
    public static function getCourseContent($crash_id='', $course_id='')
    {
      $courseContent='';
      if($crash_id == '' && $course_id != '')
      {
         $courseContent = Course::select('id','description', 'link', 'crash_id')->where('id', $course_id)->first();
      }else{
        $courseContent = Course::select('id','description', 'link', 'crash_id')->where('crash_id', $crash_id)->first();
      }
      return $courseContent;
    }
    public static function getNextCourse($crash_id, $course_id)
    {
      $courseContent = Course::select('id','description', 'link', 'crash_id')->where('crash_id', $crash_id)->where('id', '>', $course_id)->first();
      return $courseContent;
    }
    public static function getPreviousCourse($crash_id, $course_id)
    {
       $courseContent = Course::select('id','description', 'link', 'crash_id')->where('crash_id', $crash_id)->where('id', '<', $course_id)->orderByDesc('created_at')->first();
       return $courseContent;
    }
    public static function max($crash_id)
    {
       return Course::select('id')->where('crash_id', $crash_id)->orderByDesc('created_at')->first();
    }
    public static function min($crash_id)
    {
      return Course::select('id')->where('crash_id', $crash_id)->first();
    }
	
}

?>