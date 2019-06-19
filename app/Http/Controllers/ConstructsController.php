<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Construct;
use App\Room;
use App\Complex;
use App\Reward;
class ConstructsController extends Controller
{
    public function index(){
        $constructs=Construct::all();
        return view('constructs.index',compact('constructs'));
    }
    public function destroy($id){
        $construct=Construct::find($id);
        $construct->delete();
        return(redirect(route('constructs.index')));
    }
    public function addForm(){
        return view('constructs.addForm');
    }
    public function create(Request $request){
        $construct=new Construct();
        $construct->name=$request->name;
        $construct->save();
        return(redirect(route('constructs.index')));
    }
    public function edit(Request $request){
        $construct=Construct::find($request->id);
        $construct->name=$request->name;
        $construct->save();
        return(redirect(route('constructs.index')));
    }
    public function editForm($id){
        $construct=Construct::find($id);
        return view('constructs.editForm',compact('construct'));
    }
    public function addComForm($id){
        $construct=Construct::find($id);
        $rooms=Room::all();
        return view('constructs.addComForm',compact('construct','rooms'));
    }
    public function ComCreate(Request $request){
        //$construct=Construct::find($request->id);
        $complex=new Complex;
        $complex->name=$request->name;
        $complex->construct_id=$request->id;
        $complex->save();
        $rooms=Room::all();
        foreach($rooms as $room){
            $id=$room->id;
            $reward= new Reward;
            $reward->room_id=$room->id;
            $reward->percent=$request->$id/100;
            $reward->complex_id=$complex->id;
            $reward->save();
        }


        return redirect(route('constructs.editForm',['id'=>$request->id]));
    }
    public function ComDestroy($id){
        $complex=Complex::find($id);
        $complex->delete();
        return redirect(route('constructs.index'));
    }
    public function ComRewardsForm($id){
        $complex=Complex::find($id);
        $rooms=Room::all();
        return view('constructs.ComRewardsForm',compact('complex','rooms'));
    }
    public function ComEdit(Request $request){
        $complex=Complex::find($request->id);
        $complex->name=$request->name;
       // $complex->construct_id=$request->id;
        $complex->save();
        $rooms=Room::all();
        $deletedRows = Reward::where('complex_id',$complex->id)->delete();
        foreach($rooms as $room){
            $id=$room->id;
            $reward= new Reward;
            $reward->room_id=$room->id;
            $reward->percent=$request->$id/100;
            $reward->complex_id=$request->id;
            $reward->save();
        }
        return redirect(route('constructs.ComRewardsForm',['id'=>$request->id]));
    }
}
