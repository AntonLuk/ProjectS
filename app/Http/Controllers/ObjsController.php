<?php

namespace App\Http\Controllers;

use App\Application;
use App\Comment;
use App\Room;
use Illuminate\Http\Request;
use App\TypeMaterial;
use App\TypeOfObj;
use App\SanNode;
use App\Repair;
use App\District;
use App\Client;
use App\ImageObj;
use App\User;
use App\Construct;
use App\Complex;
use Illuminate\Support\Facades\Auth;
use App\Obj;
use App\ObjComplex;
use Illuminate\Support\Facades\Storage;
use Zizaco\Entrust\Entrust;
use App\Http\Controllers\SearchController;
class ObjsController extends Controller
{
    public function addForm(){
        $applications=Application::where([
            ['type_client_id',2],
            ['user_id',Auth::user()->id]
        ])->get();
        $san_nodes=SanNode::all();
        $type_of_objs=TypeOfObj::all();
        $type_materials=TypeMaterial::all();
        $type_repairs=Repair::all();
        $districts=District::all();
        $users=User::all();
        $constructs=Construct::all();
        $complexs=Complex::all();
        $rooms=Room::all();
        return view('objs.add',compact('san_nodes','type_materials','type_of_objs','type_repairs','districts','applications','users','constructs','complexs','rooms'));
        //return(dd($districts));
    }
    public function destroy($id){
        $obj=Obj::find($id);
        $obj->delete();
        return redirect(route('objs.index'));
    }
    public function index(){
        $user=Auth::user();
        if($user->hasRole('administrator')){
            $objs=Obj::with('images')->paginate(10);
        }else{
            $objs = Obj::whereHas('application', function ($query) {
                $query->where('user_id',Auth::user()->id);
            })->paginate(10);
        }

        //$objs=Application::where('user_id',$user->id)->get();
        $searchForm=$this->SearchForm();
        //return(dd($objs));
        return view('objs.index',compact('objs','searchForm'));
        //return(dd($searchForm['users']));
       //return(dd(Auth::user()->id));
    }
    public function SearchForm(){
        $result = [];
        $result['type_objs'] = TypeOfObj::all();
        $result['type_materials'] = TypeMaterial::all();
        $result['san_nodes']=SanNode::all();
        $result['type_repairs']=Repair::all();
        $result['districts']=District::all();
        $result['users']=User::all();
        $result['constructs']=Construct::all();
        $result['complexs']=Complex::all();
        return $result;
    }
    public function search(Request $request){
        $objs=Obj::where([['address', 'LIKE', "%$request->address%"],['user_id',$request->user_id]])->paginate(10);
        $searchForm=$this->SearchForm();
        return view('objs.index',compact('objs','searchForm'));
        //return dd(count($objs));
    }
    public function searchAdd($address){
        $objs=Obj::where('address', 'LIKE', "%$address%")->paginate(10);
        $searchForm=$this->SearchForm();
        return view('objs.index',compact('objs','searchForm'));
    }
    public function create(Request $request){
        $obj=new Obj();
        $obj->geo_lat=$request->geo_lat;
        $obj->geo_lon=$request->geo_lon;
        $obj->city=$request->city;
        $obj->street=$request->street;
        $obj->house=$request->house;
        $obj->address=$request->address;
        $obj->flat=$request->flat;
        $obj->district_id=$request->district_id;
        $obj->years_construct=$request->year_construct;
        $obj->type_of_obj_id=$request->type_obj_id;
        $obj->type_material_id=$request->type_material_id;
        $obj->room_id=$request->room;
        $obj->area=$request->area;
        $obj->repair_id=$request->repair_id;
        $obj->san_node_id=$request->san_node_id;
        $obj->floor=$request->floor;
        $obj->floors=$request->floors;
        $obj->price=$request->price;
        $obj->description=$request->description;
        $obj->application_id=$request->application_id;
        $obj->number_client=$request->number_client;
        if($request->user_id==null){
            $obj->user_id=Auth::user()->id;
        }
        else{
            $obj->user_id=$request->user_id;
        }

        $obj->save();
        if($request->complex_id!=null){
            $objCopm=new ObjComplex();
            $objCopm->obj_id=$obj->id;
            $objCopm->complex_id=$request->complex_id;
            $objCopm->save();
        }
        if($request->hasFile('image_path')){
            $files=$request->file('image_path');
            $destinationPath=public_path().Storage::url('/images/objs/').$obj->id.'/';
            foreach ($files as $file){
                $image=new ImageObj();
                $filename=str_random(8).'_'.($obj->id).'_'.$file->getClientOriginalName();
                $file->move($destinationPath,$filename);
                //Storage::disk('rackspace')->put($destinationPath,$filename);
                $image->image_path=$filename;
                $image->obj_id=$obj->id;
                $image->save();
            }
        }

        //$destinationPath=public_path().Storage::url('/images/objs/');
        return(redirect(route('objs.index')));
    }
    public function edit(Request $request){
        $obj=Obj::find($request->id);
        $obj->geo_lat=$request->geo_lat;
        $obj->geo_lon=$request->geo_lon;
        $obj->city=$request->city;
        $obj->street=$request->street;
        $obj->house=$request->house;
        $obj->flat=$request->flat;
        $obj->address=$request->address;
        $obj->district_id=$request->district_id;
        $obj->years_construct=$request->year_construct;
        $obj->type_of_obj_id=$request->type_obj_id;
        $obj->type_material_id=$request->type_material_id;
        $obj->room_id=$request->room;
        $obj->area=$request->area;
        $obj->repair_id=$request->repair_id;
        $obj->san_node_id=$request->san_node_id;
        $obj->floor=$request->floor;
        $obj->floors=$request->floors;
        $obj->price=$request->price;
        $obj->description=$request->description;
        $obj->application_id=$request->application_id;
        $obj->number_client=$request->number_client;
        if($request->user_id==null){
            $obj->user_id=Auth::user()->id;
        }
        else{
            $obj->user_id=$request->user_id;
        }

        $obj->save();
        if($request->complex_id!=null){
            $objCopm=new ObjComplex();
            $objCopm->obj_id=$obj->id;
            $objCopm->complex_id=$request->complex_id;
            $objCopm->save();
        }
        if($request->hasFile('image_path')){
            $files=$request->file('image_path');
            $destinationPath=public_path().Storage::url('/images/objs/').$obj->id.'/';
            $image=ImageObj::where('obj_id',$request->id)->delete();
            foreach ($files as $file){
                $image=new ImageObj();
                $filename=str_random(8).'_'.($obj->id).'_'.$file->getClientOriginalName();
                $file->move($destinationPath,$filename);
                $image->image_path=$filename;
                $image->obj_id=$obj->id;
                $image->save();
            }
        }

        //$destinationPath=public_path().Storage::url('/images/objs/');
        //return(dd($request));
        return(redirect(route('objs.index')));
    }
    public function show($id){
        $applications=Application::where([
            ['type_client_id',2],
            ['user_id',Auth::user()->id]
        ])->get();
        $obj=Obj::find($id);
        $san_nodes=SanNode::all();
        $type_of_objs=TypeOfObj::all();
        $type_materials=TypeMaterial::all();
        $type_repairs=Repair::all();
        $districts=District::all();
        $users=User::all();
        $constructs=Construct::all();
        $complexs=Complex::all();
        $rooms=Room::all();
        //$obj=Obj::find($id)->with('type_obj')->first();
        return view('objs.show',compact('obj','san_nodes','type_materials','type_of_objs','type_repairs','districts','applications','users','constructs','complexs','rooms'));
        //return(dd($obj));
    }

}
