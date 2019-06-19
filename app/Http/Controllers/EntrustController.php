<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\PermissionRole;
class EntrustController extends Controller
{
    public function index1(){
        $roles=Role::all();
        $permissions=Permission::with('roles')->get();
        //return Excel::download(new UsersExport, 'users.xlsx');
        //return Excel::download(new UsersExport, 'users.xlsx');
       //return dd($permissions);
       return view('entrust.index',compact('roles','permissions'));
    }
    public function index(){
        $roles=Role::all();
        //$permissions=Permission::with('roles')->get();
        return view('entrust.index',compact('roles'));
    }
    public function applyset(Request $request){
        $roles=Role::all();
        $permissons=Permission::all();
        $test=$request->request->all();

//        foreach ($request as $req){
//            foreach ($req as $permission){
//                $per=Permission::find($permission);
//                array_push($test,$per);
//            }
//        }

        return dd($test);
    }
    public function show($id){
        $role=Role::find($id);

        $permissions=Permission::all();

        return view('entrust.show',compact('role','permissions'));
    }
    public function edit(Request $request){
        //return dd($request->);
        $role=Role::find($request->id);
        $permissions=Permission::all();
        $deletedRows = PermissionRole::where('role_id', $role->id)->delete();
        foreach($permissions as $permission){
            $idper=$permission->id;
           // return dd($request->$idper);
            if($request->$idper=='on'){
                $perrole = PermissionRole::where([['permission_id',$permission->id],['role_id',$role->id]])->first();
                if ($perrole === null) {
                    $per=new PermissionRole;
                    $per->role_id=$role->id;
                    $per->permission_id=$permission->id;
                    $per->timestamps = false;
                    $per->save();
                }
                else{

                }
            }
//            return dd($role->can($name));
        }
        //return view('entrust.show',compact('role','permissions'));
        return redirect(route('entrust.index'));
    }
}
