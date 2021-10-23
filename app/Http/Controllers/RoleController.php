<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller{
    function allPermission(){
        return view('Backend.Role Manager.permission',[
            'permissions'=>Permission::latest()->simplePaginate(),
            'permissionCount'=>Permission::count(),
        ]);
    }

    function permissionPost(Request $request){
        $request->validate([
            'permission'=>['required','unique:permissions,name'],
        ],[
            'permission.required'=>'Please Enter Permission',
            'permission.unique'=>'Permission Exists',
        ]);
        Permission::create(['name' => $request->permission]);
        $notification=array(
            'message'=> 'Permission Added Successfully',
            'alert-type'=>'success',
        );
        return back()->with($notification);
    }

    function permissionEdit($permission_id){
        return view('Backend.Role Manager.permission-edit',[
            'permissionEdit'=>Permission::findOrFail($permission_id),
        ]);
    }

    function permissionUpdatePost(Request $request){
        $permissionUpdate=Permission::findOrFail($request->p_id);
        $permissionUpdate->name=$request->permission;
        $permissionUpdate->save();
        $notification=array(
            'message'=> 'Permission Updated Successfully',
            'alert-type'=>'success',
        );
        return back()->with($notification);
    }

    function permissionDelete($permission_id){
        Permission::findOrFail($permission_id)->delete();
        $notification=array(
            'message'=> 'Permission Deleted Successfully',
            'alert-type'=>'danger',
        );
        return back()->with($notification);
    }

    function allRole(){
        return view('Backend.Role Manager.all-role',[
            'roles'=>Role::latest()->simplePaginate(),
            'roleCount'=>Role::count(),
        ]);
    }

    function rolePost(Request $request){
        $request->validate([
            'role'=>['required','unique:roles,name'],
        ],[
           'role.required'=>'Enter Role Name', 
           'role.unique'=>'Role Name Already Exists', 
        ]);
        Role::create(['name' => $request->role]);
        $notification=array(
            'message'=> 'Role Inserted Successfully',
            'alert-type'=>'success',
        );
        return back()->with($notification);
    }

    function roleEdit($role_id){
        return view('Backend.Role Manager.role-edit',[
            'roleEdit'=>Role::findOrFail($role_id),
        ]);
    }

    function roleUpdate(Request $request){
       $roleUpdate = Role::findOrFail($request->roles_id);
       $roleUpdate->name=$request->role;
       $roleUpdate->save();
       $notification=array(
        'message'=> 'Role Updated Successfully',
        'alert-type'=>'success',
      );
       return back()->with($notification);
    }

    function roleDelete($role_id){
       Role::findOrFail($role_id)->delete();
       $notification=array(
        'message'=> 'Role Deleted Successfully',
        'alert-type'=>'danger',
       );
       return back()->with($notification);
    }

    function roleSyncPermission(){
        return view('Backend.Role Manager.role-sync-permission',[
            'roles'=>Role::latest()->simplePaginate(),
            'permissions'=>Permission::latest()->get(),
        ]);
    }

    function roleSyncPost(Request $request){
        $request->validate([
            'role_id'=>['required'],
            'permission_id'=>['required'],
        ],[
            'role_id.required'=>'Select Role',
            'permission_id.required'=>'Select Permission',
        ]);
        $role = Role::findOrFail($request->role_id);
        $role->syncPermissions($request->permission_id);
        return back();
    }

    function roleSyncUser(){
        return view('Backend.Role Manager.role-sync-user',[
            'users'=>User::latest()->simplePaginate(5),
            'roles'=>Role::latest()->get(),
        ]);
    }

    function roleSyncUserPost(Request $request){
        $request->validate([
            'user_id'=>['required'],
            'role_id'=>['required'],
        ],[
            'user_id.required'=>'Select User Name',
            'role_id.required'=>'Assign Role',
        ]);
        $user=User::findOrFail($request->user_id);
        $user->syncRoles($request->role_id);
        return back();
    }
    






















}
