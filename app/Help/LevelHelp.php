<?php 
namespace App\Help;

use App\Models\Assistant;
use App\Models\Level;
use Illuminate\Support\Facades\DB;
/**
 * 
 */
class LevelHelp
{
	
	public static function levels()
	{
		$levels=Level::where('status', 1)->orderByDesc('created_at')->paginate(7);
		return $levels;
	}
	public static function store($request)
	{
		$level = new Level();
		$level->level_name=$request->level_name;
		$level->level_code=$request->level_code;
		if($level->save())
		{
			return true;
		}else{
			return false;
		}
	}
	public static function update($request, $level)
	{
		$level->level_name=$request->level_name;
		$level->level_code=$request->level_code;
		if($level->save())
		{
			return true;
		}else{
			return false;
		}
	}
	public static function postProgram($request, $level)
	{
		$assistant=new Assistant();
		$assistant->university_id=$request->university_id;
		$assistant->level_id=$level->id;
		$assistant->program_id=$request->program_id;
		$assistant->ways=$request->ways;
		$assistant->faculty_id=$request->faculty_id;
		if($assistant->save())
		{
			return true;
		}else{
			return false;
		}
	}
	public static function getProgram()
	{
		return DB::table('assistants')
            ->join('programs', 'programs.id', '=', 'assistants.program_id')
            ->join('universities', 'universities.id', '=', 'assistants.university_id')
            ->join('faculties', 'faculties.id', '=', 'assistants.faculty_id')
            ->join('levels', 'levels.id', '=', 'assistants.level_id')
            ->select('assistants.id', 'assistants.ways', 'universities.university_name', 'programs.program_name', 'faculties.faculty_name', 'levels.level_name')
            ->get();
	}
	public static function seeOrNebSubjects($id)
	{
		if($id==1)
		{
			return DB::table('see_neb_assistants')
            ->join('subjects', 'subjects.id', '=', 'see_neb_assistants.subject_id')
            ->select('see_neb_assistants.id', 'see_neb_assistants.subject_code','subjects.subject_name', 'see_neb_assistants.assign')
            ->where('see_neb_assistants.level_id', $id)
            ->get();
		}else{
			return DB::table('see_neb_assistants')
            ->join('subjects', 'subjects.id', '=', 'see_neb_assistants.subject_id')
            ->join('faculties', 'faculties.id', '=', 'see_neb_assistants.faculty_id')
            ->select('see_neb_assistants.id', 'see_neb_assistants.subject_code', 'see_neb_assistants.class',  'subjects.subject_name',  'faculties.faculty_name', 'see_neb_assistants.assign')
            ->where('see_neb_assistants.level_id', $id)
            ->get();
		}
	}
}

 ?>