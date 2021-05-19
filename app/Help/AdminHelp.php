<?php 
namespace App\Help;

use App\Models\BCMS;
use App\Models\Course;
use App\Models\Crash;
use App\Models\Level;
use App\Models\SeeNeb;
use App\Models\University;
use Auth;
use Illuminate\Support\Facades\DB;
/**
 * 
 */
class AdminHelp
{
	public static function getLevels()
	{
	     return Level::select('level_name', 'id')->where('id', '>', 2)->get();
	}
	public static function getSEEorNEBSubjects($id)
	{
		return DB::table('see_neb_assistants')
            ->join('subjects', 'subjects.id', '=', 'see_neb_assistants.subject_id')
            ->select('see_neb_assistants.id', 'subjects.subject_name', 'see_neb_assistants.class',)
            ->where('see_neb_assistants.level_id', $id)
            ->where('see_neb_assistants.assign', '=', Auth::user()->id)
            ->get();

	}
	public static function universitySubjects($id)
   	{
   		return DB::table('subject_assistants')
		    ->join('assistants', 'assistants.id', '=', 'subject_assistants.assistant_id')
            ->join('universities', 'universities.id', '=', 'assistants.university_id')
            ->join('subjects', 'subjects.id', '=', 'subject_assistants.subject_id')
            ->join('faculties', 'faculties.id', '=', 'assistants.faculty_id')
            ->join('programs', 'programs.id', '=', 'assistants.program_id')
            ->join('years', 'years.id', '=', 'subject_assistants.year_id')
            ->select('universities.university_name', 'subjects.subject_name', 'subject_assistants.id', 'assistants.ways', 'faculties.faculty_name', 'programs.program_name', 'years.year_name', 'subject_assistants.subject_code')
            ->where('assistants.level_id', '=', $id)
            ->where('subject_assistants.assign', '=', Auth::user()->id)
            ->orderByDesc('subject_assistants.created_at')
            ->paginate(7);
   	}
   	public static function getSearch($request)
   	{
   		    $is_regular="";
            switch ($request->query1) {
                case 'r':
                    $is_regular=1;
                    break;
                case 're':
                    $is_regular=1;
                    break;
                case 'reg':
                    $is_regular=1;
                    break;
                case 'regu':
                    $is_regular=1;
                    break;
                case 'regul':
                    $is_regular=1;
                    break;
                case 'regular':
                    $is_regular=1;
                    break;
                case 'p':
                    $is_regular=0;
                    break;
                case 'pa':
                    $is_regular=0;
                    break;
                case 'par':
                    $is_regular=0;
                    break;
                case 'part':
                    $is_regular=0;
                    break;
                case 'part':
                    $is_regular=0;
                    break;
                case 'partia':
                    $is_regular=0;
                    break;
                case 'partial':
                    $is_regular=0;
                    break;
                default:
                    $is_regular=$request->query1;
                    break;
            }
            $output = '';
            $data = '';
            // $query=$request->query1;
            if($is_regular != '')
            {
                $data=DB::table('see_nebs')
                    ->join('see_neb_assistants', 'see_nebs.seeneb_id', '=', 'see_neb_assistants.id')
                    ->join('subjects', 'subjects.id', '=', 'see_neb_assistants.subject_id')
                    ->where('see_neb_assistants.level_id', '=', $request->level_id)
                    ->where('subjects.subject_name', 'like', '%'.$is_regular.'%')
                    ->orWhere('see_nebs.year', 'like', '%'.$is_regular.'%')
                    ->orWhere('see_nebs.is_regular', 'like', '%'.$is_regular.'%')
                    ->select('subjects.subject_name', 'see_nebs.is_regular', 'see_nebs.year', 'see_nebs.mode', 'see_nebs.edition', 'see_nebs.publication', 'see_nebs.id', 'see_nebs.file_name', 'see_nebs.medium', 'see_neb_assistants.assign')
                    ->orderByDesc('see_nebs.created_at')
                    ->get();
            }
            else
            {
                $data=DB::table('see_nebs')
                    ->join('see_neb_assistants', 'see_nebs.seeneb_id', '=', 'see_neb_assistants.id')
                    ->join('subjects', 'subjects.id', '=', 'see_neb_assistants.subject_id')
                    ->select('subjects.subject_name', 'see_nebs.is_regular', 'see_nebs.year', 'see_nebs.mode', 'see_nebs.edition', 'see_nebs.publication', 'see_nebs.id', 'see_nebs.file_name', 'see_nebs.medium', 'see_neb_assistants.assign')
                    ->where('see_neb_assistants.assign', Auth::user()->id)
                    ->where('see_neb_assistants.level_id', $request->level_id)
                    ->orderByDesc('see_nebs.created_at')
                    ->get(7);
            }

            $total_row=$data->count();
            if($total_row>0)
            {
                $n=1;
                foreach ($data as $old) {
                    $is_regular="";
                    if($old->is_regular==1)
                    {
                        $is_regular="Regular";
                    }else{
                        $is_regular="Partial";
                    }
                if($old->mode==1 && $old->assign==Auth::user()->id){
                   $output .='
                     <tr>
                        <td>'.$n++.'</td>
                        <td>'.$old->subject_name.'</td>
                        <td>'.$old->year.'</td>
                        <td>'.$is_regular.'</td>
                        <td>
                            <form action="'.route('SEEorNEB.destroy', $old->id).'" method="post">
                            <input type="hidden" name="_token" value="'.csrf_token().'"/>
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button type="submit" class="btn btn-link"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                        <td><a href=".'.route('SEEorNEB.destroy', $old->id).'."><i class="fab fa-readme"></i></a></td>
                        <td><a href="'.asset('asset/see-neb/'.$old->file_name).'"><i class="fas fa-download"></i></a></td>
                     </tr>
                     
                   ';
                }
                }
            }
            else
            {
                 $output='
                        <tr>
                          <td colspan="8"><center>Record Not found</center></td>
                        </tr>
                 ';
            }
              
            $data=array(
                 'table_data'    =>$output
            );
            return $data;
   	}
   	   	public static function getSearch2($request)
   	{
            $output = '';
            $data = '';
            $query=$request->query1;
            if($query != '')
            {
                $data=DB::table('see_nebs')
                    ->join('see_neb_assistants', 'see_nebs.seeneb_id', '=', 'see_neb_assistants.id')
                    ->join('subjects', 'subjects.id', '=', 'see_neb_assistants.subject_id')
                    ->where('see_neb_assistants.level_id', '=', $request->level_id)
                    ->where('see_neb_assistants.assign', '=', Auth::user()->id)
                    ->where('see_nebs.mode', '=', $request->mode)
                    ->where('subjects.subject_name', 'like', '%'.$query.'%')
                    ->orWhere('see_nebs.year', 'like', '%'.$query.'%')
                    ->orWhere('see_nebs.edition', 'like', '%'.$query.'%')
                    ->orWhere('see_nebs.publication', 'like', '%'.$query.'%')
                    ->orWhere('see_nebs.medium', 'like', '%'.$query.'%')
                    ->select('subjects.subject_name', 'see_nebs.year', 'see_nebs.mode', 'see_nebs.edition', 'see_nebs.publication', 'see_nebs.id', 'see_nebs.file_name', 'see_nebs.medium', 'see_neb_assistants.assign')
                    ->orderByDesc('see_nebs.created_at')
                    ->get();
            }
            else
            {
                $data=DB::table('see_nebs')
                    ->join('see_neb_assistants', 'see_nebs.seeneb_id', '=', 'see_neb_assistants.id')
                    ->join('subjects', 'subjects.id', '=', 'see_neb_assistants.subject_id')
                    ->select('subjects.subject_name', 'see_nebs.is_regular', 'see_nebs.year', 'see_nebs.mode', 'see_nebs.edition', 'see_nebs.publication', 'see_nebs.id', 'see_nebs.file_name', 'see_nebs.medium', 'see_neb_assistants.assign')
                    ->where('see_neb_assistants.assign', Auth::user()->id)
                    ->where('see_neb_assistants.level_id', $request->level_id)
                    ->orderByDesc('see_nebs.created_at')
                    ->get(7);
            }

            $total_row=$data->count();
            if($total_row>0)
            {
                $n=1;
                foreach ($data as $old) {
                if($old->mode==2 && $old->assign==Auth::user()->id){
                	$medium="";
                	if($old->medium===1)
                	{
                		$medium="English";
                	}elseif($old->medium===0){
                		$medium="Nepali";
                	}
                   $output .='
                     <tr>
                        <td>'.$n++.'</td>
                        <td>'.$old->subject_name.'</td>
                        <td>'.$old->year.'</td>
                        <td>'.$old->edition.'</td>
                        <td>'.$old->publication.'</td>
                         <td>'.$medium.'</td>
                        <td>
                            <form action="'.route('SEEorNEB.destroy', $old->id).'" method="post">
                            <input type="hidden" name="_token" value="'.csrf_token().'"/>
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button type="submit" class="btn btn-link"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                        <td><a href=".'.route('SEEorNEB.destroy', $old->id).'."><i class="fab fa-readme"></i></a></td>
                        <td><a href="'.asset('asset/see-neb/'.$old->file_name).'"><i class="fas fa-download"></i></a></td>
                     </tr>
                     
                   ';
                }
                }
            }
            else
            {
                 $output='
                        <tr>
                          <td colspan="8"><center>Record Not found</center></td>
                        </tr>
                 ';
            }
              
            $data=array(
                 'table_data'    =>$output
            );
            return $data;
   	}
    public static function getContent($request)
    {
            $output = '';
            $data = '';
            $query=$request->query1;
            if($query != '')
            {
                $data=DB::table('subject_assistants')
                    ->join('assistants', 'assistants.id', '=', 'subject_assistants.assistant_id')
                    ->join('universities', 'universities.id', '=', 'assistants.university_id')
                    ->join('subjects', 'subjects.id', '=', 'subject_assistants.subject_id')
                    ->join('faculties', 'faculties.id', '=', 'assistants.faculty_id')
                    ->join('programs', 'programs.id', '=', 'assistants.program_id')
                    ->join('years', 'years.id', '=', 'subject_assistants.year_id')
                    ->where('subject_assistants.assign', '=', Auth::user()->id)
                    ->where('subjects.subject_name', 'like', '%'.$query.'%')
                    ->orWhere('years.year_name', 'like', '%'.$query.'%')
                    ->orWhere('universities.university_name', 'like', '%'.$query.'%')
                    ->orWhere('programs.program_name', 'like', '%'.$query.'%')
                    ->orWhere('faculties.faculty_name', 'like', '%'.$query.'%')
                    ->orWhere('universities.university_name', 'like', '%'.$query.'%')
                    ->orWhere('subject_assistants.subject_code', 'like', '%'.$query.'%')
                    ->orWhere('universities.university_name', 'like', '%'.$query.'%')
                    ->select('universities.university_name', 'subjects.subject_name', 'subject_assistants.id', 'assistants.ways', 'faculties.faculty_name', 'programs.program_name', 'years.year_name', 'subject_assistants.subject_code', 'assistants.level_id', 'subject_assistants.assign')
                    ->orderByDesc('subject_assistants.created_at')
                    ->get(7);
            }
            else
            {
                $data=DB::table('subject_assistants')
                    ->join('assistants', 'assistants.id', '=', 'subject_assistants.assistant_id')
                    ->join('universities', 'universities.id', '=', 'assistants.university_id')
                    ->join('subjects', 'subjects.id', '=', 'subject_assistants.subject_id')
                    ->join('faculties', 'faculties.id', '=', 'assistants.faculty_id')
                    ->join('programs', 'programs.id', '=', 'assistants.program_id')
                    ->join('years', 'years.id', '=', 'subject_assistants.year_id')
                    ->select('universities.university_name', 'subjects.subject_name', 'subject_assistants.id', 'assistants.ways', 'faculties.faculty_name', 'programs.program_name', 'years.year_name', 'subject_assistants.subject_code', 'assistants.level_id')
                    ->where('subject_assistants.assign', '=', Auth::user()->id)
                    ->orderByDesc('subject_assistants.created_at')
                    ->get(7);
            }

            $total_row=$data->count();
            if($total_row>0)
            {
                $n=1;
                foreach ($data as $subject) {
                    $year="";
                    if($subject->ways===1)
                    {
                        $year="Year";
                    }else{
                        $year="Semester";
                    }
                if($subject->level_id==$request->level_id && $subject->assign==Auth::user()->id)
                {
                   $output .='
                     <tr>
                        <td>'.$n++.'</td>
                        <td>'.$subject->subject_name.'</td>
                        <td>'.$subject->subject_code.'</td>
                        <td>'.$subject->year_name.' '.$year.'</td>
                        <td>'.$subject->program_name.'</td>
                        <td>'.$subject->university_name.'</td>
                        <td>'.$subject->faculty_name.'</td>
                        <td>
                            <a href="'.route('BCorMS.upload', $subject->id).'"><i class="fas fa-upload"></i></a>
                        </td>
                     </tr> 
                   ';
                }
                }
            }
            else
            {
                 $output='
                        <tr>
                          <td colspan="8"><center>Record Not found</center></td>
                        </tr>
                 ';
            }
              
            $data=array(
                 'table_data'    =>$output
            );
            return $data;
    }
    public static function getShow($id)
    {
        return DB::table('subject_assistants')
            ->join('assistants', 'assistants.id', '=', 'subject_assistants.assistant_id')
            ->join('universities', 'universities.id', '=', 'assistants.university_id')
            ->join('subjects', 'subjects.id', '=', 'subject_assistants.subject_id')
            ->join('faculties', 'faculties.id', '=', 'assistants.faculty_id')
            ->join('programs', 'programs.id', '=', 'assistants.program_id')
            ->join('years', 'years.id', '=', 'subject_assistants.year_id')
            ->select('universities.university_name', 'subjects.subject_name', 'subject_assistants.id', 'assistants.ways', 'faculties.faculty_name', 'programs.program_name', 'years.year_name', 'subject_assistants.subject_code')
            ->where('subject_assistants.id', '=', $id)
            ->where('subject_assistants.assign', '=', Auth::user()->id)
            ->orderByDesc('subject_assistants.created_at')
            ->get();
    }
	public static function nbdQStore($request)
	{
		$file = $request->file('file');
        $destinationPath = 'asset/see-neb/';
        $originalFile = $file->getClientOriginalName();
        $filename=$request->subject_name.strtotime(date('Y-m-d-H:isa')).$originalFile;
        $file->move($destinationPath, $filename);
		$seeNeb = new SeeNeb();
		$seeNeb->year=$request->year;
		$seeNeb->seeneb_id=$request->subject_name;
		$seeNeb->is_regular=$request->is_regular;
		$seeNeb->mode=$request->mode;
		$seeNeb->edition=$request->edition;
		$seeNeb->publication=$request->publication;
		$seeNeb->medium=$request->medium;
		$seeNeb->file_name=$filename;
		if($seeNeb->save())
		{
			return true;
		}else{
			return false;
		}
	}
	public static function getOldQuestions($id)
	{
		return DB::table('see_nebs')
		    ->join('see_neb_assistants', 'see_nebs.seeneb_id', '=', 'see_neb_assistants.id')
            ->join('subjects', 'subjects.id', '=', 'see_neb_assistants.subject_id')
            ->select('subjects.subject_name', 'see_nebs.is_regular', 'see_nebs.year', 'see_nebs.mode', 'see_nebs.edition', 'see_nebs.publication', 'see_nebs.id', 'see_nebs.file_name', 'see_nebs.medium')
            ->where('see_neb_assistants.level_id', $id)
            ->where('see_neb_assistants.assign', Auth::user()->id)
            ->orderByDesc('see_nebs.created_at')
            ->paginate(7);
	}
	public static function check1($year, $subject_id, $is_regular)
	{
		$check=SeeNeb::where('year', $year)->where('seeneb_id', $subject_id)->where('is_regular', $is_regular)->first();
		if($check==null)
		{
			return true;
		}else{
			return false;
		}
	}
	public static function check2($year, $subject_id, $edition, $publication, $medium)
	{
		$check=SeeNeb::where('year', $year)->where('seeneb_id', $subject_id)->where('edition', $edition)->where('publication', $publication)->where('medium', $medium)->first();
		if($check==null)
		{
			return true;
		}else{
			return false;
		}
	}
    public static function getContents($id)
    {
        $data=BCMS::where('subject_assistant_id', $id)->select('id', 'mode', 'year', 'edition', 'publication', 'medium', 'file_name', 'id')->orderByDesc('created_at')->paginate(7);
        return $data;
    }
     public static function getContents1($request, $mode)
    {
        $data="";
        if($mode ==0)
        {
            $data=BCMS::where('subject_assistant_id', $request->assistant_id)->select('id', 'mode', 'year', 'edition', 'publication', 'medium', 'file_name')->orderByDesc('created_at')->paginate(7);
        }else{
            $data=BCMS::where('subject_assistant_id', $request->assistant_id)->where('mode', '=', $mode)->select('id', 'mode', 'year', 'edition', 'publication', 'medium', 'file_name')->orderByDesc('created_at')->paginate(7);
        }
        return $data;
    }
    public static function checkContent($assistant_id, $mode, $year, $medium)
    {
        $data="";
        if($mode==1)
        {
            $data = BCMS::where('subject_assistant_id', $assistant_id)->where('mode', $mode)->where('year', $year)->first();
        }elseif($mode==2 || $mode==3)
        {
            $data = BCMS::where('subject_assistant_id', $assistant_id)->where('mode', $mode)->where('year', $year)->where('medium', $medium)->first();
        }
        if($data !== null)
        {
            return false;
        }else{
            return true;
        }
    }
    public static function contentStore($request)
    {
        $file = $request->file('file_name');
        $destinationPath = 'asset/bc-ms/';
        $originalFile = $file->getClientOriginalName();
        $filename=strtotime(date('Y-m-d-H:isa')).$originalFile;
        $file->move($destinationPath, $filename);
        $bcMS = new BCMS();
        $bcMS->year=$request->year;
        $bcMS->subject_assistant_id=$request->assistant_id;
        $bcMS->mode=$request->mode;
        $bcMS->edition=$request->edition;
        $bcMS->publication=$request->publication;
        $bcMS->medium=$request->medium;
        $bcMS->file_name=$filename;
        if($bcMS->save())
        {
            return true;
        }else{
            return false;
        }
    }
    public static function searchContents($request)
     {
            $output = '';
            $data = '';
            $query=$request->query1;
            if($query != '')
            {
                $data=DB::table('subject_assistants')
                    ->join('b_c_m_s', 'b_c_m_s.subject_assistant_id', '=', 'subject_assistants.id')
                    ->select('b_c_m_s.id', 'b_c_m_s.year', 'b_c_m_s.publication', 'b_c_m_s.mode', 'b_c_m_s.edition', 'b_c_m_s.medium', 'subject_assistants.assign', 'b_c_m_s.file_name')
                ->Where('b_c_m_s.year', 'like', '%'.$query.'%')
                ->orWhere('b_c_m_s.edition', 'like', '%' .$query. '%')
                ->orWhere('b_c_m_s.publication', 'like', '%' .$query. '%')
                ->orderByDesc('b_c_m_s.created_at')
                ->get();
            }
            else
            {
                $data=DB::table('subject_assistants')
                    ->join('b_c_m_s', 'b_c_m_s.subject_assistant_id', '=', 'subject_assistants.id')
                    ->select('b_c_m_s.id', 'b_c_m_s.year', 'b_c_m_s.publication', 'b_c_m_s.mode', 'b_c_m_s.edition', 'b_c_m_s.medium', 'subject_assistants.assign', 'b_c_m_s.file_name')
                ->orderByDesc('b_c_m_s.created_at')
                ->get(7);
            }

            $total_row=$data->count();
            if($total_row>0)
            {
                $n=1;
                foreach ($data as $subject) {
                    $year="";
                    $medium="";
                    if($subject->mode===1)
                    {
                        $newMode="Question Paper";
                    }elseif($subject->mode === 2){
                        $newMode="Note";
                    }elseif($subject->mode === 3){
                        $newMode="Guess Paper";
                    }else{
                        $newMode="";
                    }
                    if($subject->medium==1)
                    {
                        $medium="English Medium";
                    }else{
                        $medium="Nepali Medium";
                    }
                if($subject->assign==Auth::user()->id)
                {
                    $output .='
                     <tr>
                        <td>'.$n++.'</td>
                        <td>'.$subject->year.'</td>
                        <td>'.$newMode.'</td>
                        <td>'.$subject->year.'</td>
                        <td>'.$medium.'</td>
                        <td>'.$subject->publication.'</td>
                        <td>'.$subject->edition.'</td>
                        <td>
                            <form action="'.route('BCorMS.destroy', $subject->id).'" method="post">
                            <input type="hidden" name="_token" value="'.csrf_token().'"/>
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button type="submit" class="btn btn-link"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                         <td>
                            <a href="#"><i class="fab fa-readme"></i></a>
                        </td>
                        <td><a href="'.asset('asset/bc-ms/'.$subject->file_name).'"><i class="fas fa-download"></i></a></td>
                     </tr> 
                   ';
                }
                }
            }
            else
            {
                 $output='
                        <tr>
                          <td colspan="8"><center>Record Not found</center></td>
                        </tr>
                 ';
            }
              
            $data=array(
                 'table_data'    =>$output
            );
            return $data;
    }
    public static function getCourse($id)
    {
        $course = Crash::select('crash_name', 'crash_image', 'id')->where('assign', $id)->get();
        return $course;
    }
    public static function getCrash($id)
    {
        // $crashes = Crash::with('courses')->where('assign', Auth::user()->id)->where('id', $id)->get();
        // return $crashes;
        $courseContent= Course::where('admin_id', Auth::user()->id)->where('crash_id', $id)->orderByDesc('created_at')->first();
        return $courseContent;

    }
    public static function postAdd($request, $id)
    {
        $course = new Course();
        $course->title=$request->title;
        $course->link=$request->link;
        $course->description=$request->description;
        $course->admin_id=Auth::user()->id;
        $course->crash_id=$id;
        if($course->save())
        {
            return true;
        }else{
            return false;
        }
    }
    public static function getAll($id)
    {
       $courses= Course::select('id as course_id', 'title', 'link',)->where('crash_id', $id)->paginate(10);
       return $courses;
    }
    public static function editCoursePost($id, $request)
    {
        $course= Course::find($id);
        if($course->update($request->all()))
        {
            return true;
        }else{
            return false;
        }
    }
}

 ?>