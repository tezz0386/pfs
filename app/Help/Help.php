<?php 
  namespace App\Help;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InformationNotification;
  /**
   * 
   */
  class Help 
  {
  	public static function adminStore($request)
  	{
  		// $password=mt_rand(1000,9999);
      $password="1234";
  		$email=$request->email;
  		$admin = new Admin();
  		$admin->name=$request->name;
  		$admin->email=$email;
  		$admin->ph_no=$request->ph_no;
  		$admin->address=$request->address;
  		$admin->password=Hash::make($password);
  		$details=[
  			'username'=>$email,
  			'password'=>$password,
  		];
  		if($admin->save())
  		{
  			Notification::send($admin, new InformationNotification($details));
  			return true;
  		}else{
  			return false;
  		}
  	}
    public static function adminUpdate($request, $admin)
    {
      $admin->name=$request->name;
      $admin->email=$request->email;
      $admin->address=$request->address;
      $admin->ph_no=$request->ph_no;
      if($admin->save())
      {
        return true;
      }else{
        return false;
      }
    }
  	public static function admins()
  	{
  		$admins=Admin::where('status', 1)->orderByDesc('created_at')->paginate(7);
  		return $admins;
  	}
    public static function trash()
    {
      $admins=Admin::where('status', 0)->orderByDesc('created_at')->paginate(7);
      return $admins;
    }
  }

 ?>