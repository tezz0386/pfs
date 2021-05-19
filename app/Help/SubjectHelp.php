<?php 
namespace App\Help;

use App\Models\Faculty;
use App\Models\Level;
use App\Models\Program;
use App\Models\SeeNebAssistant;
use App\Models\Subject;
use App\Models\SubjectAssistant;
use App\Models\University;
use Illuminate\Support\Facades\DB;


/**
 * 
 */
class SubjectHelp
{
	
	public static function subjects()
	{
		return Subject::select('subject_name', 'id')->where('status', 1)->orderByDesc('created_at')->paginate(7);
	}
	public static function getSubjects()
	{
		return Subject::select('subject_name', 'id')->where('status', 1)->orderByDesc('created_at')->get();
	}
	public static function store($request)
	{
		if(Subject::create($request->all()))
		{
			return true;
		}else{
			return false;
		}
	}
	public static function update($request, $subject)
	{
		if($subject->update($request->all()))
		{
			return true;
		}else{
			return false;
		}
	}
	public static function universityName($id)
	{
		return University::select('university_name')->where('id', $id)->first();
	}
	public static function programName($id)
	{
		return Program::select('program_name')->where('id', $id)->first();
	}
	public static function levelName($id)
	{
		return Level::select('level_name')->where('id', $id)->first();
	}
	public static function facultyName($id)
	{
		return Faculty::select('faculty_name')->where('id', $id)->first();
	}
	public static function subjectAssistant($id)
	{
		return DB::table('subject_assistants')
            ->join('subjects', 'subject_assistants.subject_id', '=', 'subjects.id')
            ->join('years', 'subject_assistants.year_id', '=', 'years.id')
            ->select('subjects.subject_name', 'subject_assistants.id', 'subject_assistants.subject_code', 'subject_assistants.assign', 'years.year_name')
            ->where('assistant_id', $id)
            ->get();
	}
	public static function postSubProgram($request, $id)
	{
		$subjectAssistant=new SubjectAssistant();
        $subjectAssistant->subject_id=$request->subject_name;
        $subjectAssistant->year_id=$request->year_name;
        $subjectAssistant->subject_code=$request->subject_code;
        $subjectAssistant->assistant_id=$id;
        if($subjectAssistant->save())
        {
        	return true;
        }else{
        	return false;
        }
	}
	public static function postNebOrSeeSubProgram($request, $id)
	{
		$seeNebAssistant = new SeeNebAssistant();
        $seeNebAssistant->subject_code=$request->subject_code;
        $seeNebAssistant->level_id=$id;
        $seeNebAssistant->class=$request->class;
        $seeNebAssistant->subject_id=$request->subject_name;
        $seeNebAssistant->faculty_id=$request->faculty_name;
        if($seeNebAssistant->save())
        {
        	return true;
        }else{
        	return false;
        }
	}
	public static function assign($request)
	{
		$seeNebAssistant= SeeNebAssistant::find($request->subjectAssistant_id);
		$seeNebAssistant->assign=$request->admin_id;
		if($seeNebAssistant->save())
		{
			return true;
		}else{
			return false;
		}
	}
	public static function deleteSubject($id)
	{
		$subjectAssistant=SubjectAssistant::find($id);
		if($subjectAssistant->delete())
		{
			return true;
		}else{
			return false;
		}
	}
	public static function deleteSubjectSeeorNeb($id)
	{
		$seeNebAssistant=SeeNebAssistant::find($id);
		if($seeNebAssistant->delete())
		{
			return true;
		}else{
			return false;
		}
	}
}

 ?>