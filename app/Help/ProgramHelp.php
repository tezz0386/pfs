<?php 
namespace App\Help;

use App\Models\Program;

/**
 * 
 */
class ProgramHelp
{
	
	public static function programs()
	{
		return Program::where('status', 1)->paginate(8);
	}
	public static function store($request)
	{
		if(Program::create($request->all()))
		{
			return true;
		}else{
			return false;
		}
	}
	public static function update($request, $program)
	{
		if($program->update($request->all()))
		{
			return true;
		}else{
			return flase;
		}
	}
}

 ?>