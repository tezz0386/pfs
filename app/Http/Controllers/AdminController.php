<?php

namespace App\Http\Controllers;

use App\Help\Help;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:super');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins=Help::admins();
        $method="post";
        $action=route('admin.store');
        $admin= new Admin();
        return view('super.admin', 
            [
                'admins'=>$admins,
                'i'=>1, 
                'active'=>true,
                'method'=>$method,
                'action'=>$action,
                'btn_text'=>'Save',
                'admin'=>$admin,
                'check'=>false
            ]);
        
    }
    public function store(AdminRequest $request)
    {
        //
          $validated = $request->validated();
          if(Help::adminStore($request))
          {
            return redirect()->route('admin.index')->with('success', 'Sucesfully Registered');
          }else{
            return back()->withInput()->with('error', 'Something is wrong please try again');
          }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
        $action=route('admin.update', $admin);
        $method="post";
        return view('super.admin',
            [
                'admin'=>$admin,
                'active'=>true,
                'action'=>$action,
                'method'=>$method,
                'admins'=>Help::admins(),
                'i'=>1,
                'btn_text'=>'Update',
                'check'=>true
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, Admin $admin)
    {
        //
        if(Help::adminUpdate($request, $admin))
        {
            return redirect()->route('admin.index')->with('success', 'Sucessfully Updated');
        }else{
            return back()->withInput()->with('error', 'Something is wrong please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
        $admin->status=0;
        if($admin->save())
        {
            return back()->with('success', 'Successfully Deleted');
        }else{
            return back()->withInput()->with('error', 'Could not be delete, please try again');
        }
    }
    public function trash()
    {
      return view('super.admin-trash', ['admins'=>Help::trash(), 'i'=>1]);
    }
    public function restore(Admin $admin)
    {
        $admin->status=1;
        if($admin->save())
        {
            return back()->with('success', 'Successfully Restored');
        }else{
            return back()->with('error', 'Could not restore, please try again');
        }
    }
    public function delete(Admin $admin)
    {
       if($admin->delete())
       {
        return back()->with('success', 'Successfully Deleted, now you would not be abale to restore this item');
       }else{
        return back()->with('error', 'Could not be deleted, please try again');
       }
    }
}
