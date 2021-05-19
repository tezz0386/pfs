<?php 
namespace App\Help;

use App\Models\Crash;
use App\Models\Faculty;
/**
 * 
 */
class CrashHelp 
{
	public static function store($request)
	{
		$file = $request->file('crash_image');
        $destinationPath = 'asset/crash/';
        $originalFile = $file->getClientOriginalName();
        $filename=strtotime(date('Y-m-d-H:isa')).$originalFile;
        $file->move($destinationPath, $filename);
		$crash =new Crash();
		$crash->crash_name=$request->crash_name;
		$crash->crash_image=$filename;
		$crash->description=$request->description;
		if($crash->save())
		{
			return true;
		}else{
			return false;
		}
	}
	public static function update($request, $crash)
	{
		$filename=$crash->crash_image;
		if($request->file('crash_image') !==null)
		{
            $file = $request->file('crash_image');
            $destinationPath = 'asset/crash/';
            $originalFile = $file->getClientOriginalName();
            $filename=strtotime(date('Y-m-d-H:isa')).$originalFile;
            $file->move($destinationPath, $filename);
		}
	    $crash->crash_name=$request->crash_name;
		$crash->crash_image=$filename;
		$crash->description=$request->description;
		if($crash->save())
		{
			return true;
		}else{
			return false;
		}
	}
	public static function assign($request)
	{
		$crash=Crash::find($request->crash_id);
		$crash->assign=$request->admin_id;
		if($crash->save())
		{
			return true;
		}else{
			return false;
		}
	}
	public static function crashes()
	{
		return Crash::select('id', 'crash_name', 'assign')->get();
	}
}
?>