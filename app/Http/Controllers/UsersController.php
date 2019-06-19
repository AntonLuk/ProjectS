<?php

namespace App\Http\Controllers;

use App\Department;
use App\RoleUser;
use Illuminate\Http\Request;
use App\User;
use App\DepartmentUser;
use App\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getAllUsers()
    {
        return User::all();
    }
    public function getAllUsersWithDepartments()
    {
        $users = User::with(['departments','roles'])->paginate(10);//
        return($users);

    }
    public function anyData()
    {
        $users=$this->getAllUsersWithDepartments();
        if(Auth::user()->hasRole('administrator')){
            return view('users.index',compact('users'));
        }
        else{
            return view('users.indexEmp',compact('users'));
        }

        //return(compact('users'));

    }
    public function getAllUserInfo($id){
        //$user=User::find($id)->with(['departments','userRole'])->first();
        $user=User::where('id', $id)
            ->with(['departments','userRole'])->first();
        return($user);
    }
    public  function show($id)
    {
        $user=$this->getAllUserInfo($id);
        $departments=Department::all();
        $roles=Role::all();
         return view('users.show',compact('user','departments','roles'));
        //return(dd($user));
    }
    public function info($id){
        $user=$this->getAllUserInfo($id);
        $img = Storage::url($user->image_path);
        if($img=="/storage/"){
            $img=Storage::url('default_avatar.jpg');}

        return view('users.info',compact('user','img'));
        //return(dd($img));
    }
    public function update(Request $request){
        //return dd($request);
        if ($request->hasFile('image_path')) {
            if (!is_dir(public_path(). '/storage/users')) {
                mkdir(public_path(). '/storage/users', 0777, true);
            }
            $file = $request->file('image_path');

            $destinationPath = public_path(). '/storage/users/'.$request->id;
            $filename = str_random(8) . '_' . $file->getClientOriginalName() ;
            $file->move($destinationPath, $filename);
        }
        $user=User::where('id', $request->id)
            ->with(['departments','userRole'])->first();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->work_number=$request->work_number;
        $user->personal_number=$request->personal_number;
        if($request->hasFile('image_path')){
            $user->image_path=$filename;
        }

        $user->save();

        //$depuser='';
        //$depuser=DepartmentUser::where('user_id', '=', $request->id)->first();;

            foreach ($user->departments as $dep) {
                if ($dep->id != $request->department) {
                    $depuser=DepartmentUser::where('user_id', '=', $request->id)->first();
//                    DepartmentUser::where('user_id', $request->id)
//                        ->where('department_id', $dep->id)
//                        ->update(['department_id' => $request->department]);
                    $depuser->department_id=$request->department;
                    $depuser->save();
                }
            }


        foreach ($user->roles as $role) {

            if ($role != $request->role) {
//                RoleUser::where('user_id', $request->id)
//                    ->where('role_id', $role->id)
//                    ->update(['role_id' => $request->role]);
                $roleuser=RoleUser::where([['user_id', $request->id],['role_id', $role->id]])->first();
                $roleuser->role_id=$request->role;
                $roleuser->save();
//                $user=RoleUser::where([['user_id',$request->id],['role_id',$role->id]])->first();
//                $user->role_id=$request->role;
//                $user->save();
            }
        }

        //return(dd($request->file('image_path')));
        return redirect(route('users.data'));
        //return(dd($user1->departments));
    }
    public function addForm(){
        $departments=Department::all();
        $roles=Role::all();
        return view('users.add',compact('departments','roles'));
    }
    public function create(Request $request){

        Session::flash('flash', 'Пользователь успешно добавлен');
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->work_number=$request->work_number;
        $user->personal_number=$request->personal_number;
        $user->save();
        if ($request->hasFile('image_path')) {
            if (!is_dir(public_path(). '/storage/users')) {
                mkdir(public_path(). '/storage/users', 0777, true);
            }
            $file = $request->file('image_path');
            $destinationPath = public_path(). '/storage/users/'.$user->id;
            $filename = str_random(8) . '_' . $file->getClientOriginalName() ;
            $file->move($destinationPath, $filename);
           //Storage::disk('rackspace')->put($destinationPath,$filename);
        }
        else{
            $filename='default_avatar.jpg';
        }

        $user->image_path=$filename;
        $user->save();
        $user1=$this->getAllUserInfo($request->id);

            $depuser = new DepartmentUser();
            $depuser->insert([
                'department_id' => $request->department,
                'user_id' => $user->id
            ]);

        $role=Role::find($request->role);
        $user->attachRole($role);


        return redirect(route('users.data'));
        //return (dd(realpath($file)));
    }

    public function destroy($id){
        $user=User::find($id);
        try{$user->delete();} catch (\Illuminate\Database\QueryException $e){Session()->flash('flash_message_warning', 'Не вышло');}
        return redirect(route('users.data'));
    }

}
