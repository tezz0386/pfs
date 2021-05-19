<?php 
  namespace App\Help;

use App\Models\University;
   /**
    * 
    */
   class UniversityHelp
   {
   	
   	public static function universities()
   	{
   		$universities = University::select('university_name', 'university_code' , 'id', 'sm_form')->where('status', 1)->orderByDesc('created_at')->paginate(7);
   		return $universities;
   	}
    public static function trash()
    {
      $universities = University::where('status', 0)->orderByDesc('created_at')->paginate(7);
      return $universities;
    }
   	public static function store($request)
   	{
   		$university = new University();
   		$university->university_name=$request->university_name;
   		$university->sm_form=$request->sm_form;
   		$university->university_code=$request->university_code;
   		if($university->save())
   		{
   			return true;
   		}else{
   			return false;
   		}
   	}
    public static function update($request, $university)
    {
      $university->university_name=$request->university_name;
      $university->sm_form=$request->sm_form;
      $university->university_code=$request->university_code;
      if($university->save())
      {
        return true;
      }else{
        return false;
      }
    }
    public static function getPrograms()
    {
      
    }
   }
 ?>