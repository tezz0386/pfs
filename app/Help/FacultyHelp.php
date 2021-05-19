<?php 
namespace App\Help;

use App\Models\Faculty;
/**
 * 
 */
class FacultyHelp 
{
	
	public static function faculties()
	{
		$faculties = Faculty::select('id', 'faculty_name', 'faculty_code')->where('status', 1)->orderByDesc('created_at')->paginate(7);
		return $faculties;
	}
	public static function store($request)
	{
		if(Faculty::create($request->all()))
		{
			return true;
		}else{
			return false;
		}
	}
	public static function update($request, $faculty)
	{

		if($faculty->update($request->all()))
		{
			return true;
		}else{
			return false;
		}
	}
}


 ?>