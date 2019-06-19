<?php

namespace App\Http\Controllers;

use App\Application;
use App\Client;
use App\Comment;
use App\FilesApplication;
use App\Stage;
use App\TypeClient;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class ApplicationsController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('administrator')){
            $applications=Application::all();
        }
        else{
            $applications=Application::where('user_id',Auth::user()->id)->get();
        }

        //return dd($applications);
        return view('applications.index',compact('applications'));
    }
    public function addFormWithClient($id){
        $client=Client::find($id);
        $type_clients=TypeClient::all();
        $stages=Stage::all();
        return view('applications.addWithClient',compact('client','type_clients','stages'));
    }
    public function show($id){
        $type_clients=TypeClient::all();
        $stages=Stage::all();
        $application=Application::where('id',$id)->first();
        //$files=FilesApplication::where('application_id',$id)->get();
        //return dd($application->files);
        return view('applications.show',compact('type_clients','stages','application'));

    }
    public function create(Request $request){
        $application=new Application();
        if($request->user_id==null){
            $application->user_id=Auth::user()->id;
        }else{
            $application->user_id=$request->user_id;
        }
        $application->stage_id=$request->stage_id;
        $application->description=$request->description;
        $application->type_client_id=$request->type_client_id;
        $application->client_id=$request->client_id;
        $application->save();
        if($request->hasFile('files')){
            $files=$request->file('files');
            $destinationPath=public_path().Storage::url('/applications/').$application->id.'/';
            foreach ($files as $file){
                $image=new FilesApplication();
                $filename=($application->id).'_'.$file->getClientOriginalName();
                $file->move($destinationPath,$filename);
                $image->file_path=$filename;
                $image->application_id=$application->id;
                $image->save();
            }
        }
        //str_random(8).'_'.
        return redirect(route('applications.index'));
        //return dd($request);
    }
    public function edit(Request $request){
        $application=Application::find($request->id);
        //$application=new Application();
        if($request->user_id==null){
            $application->user_id=Auth::user()->id;
        }else{
            $application->user_id=$request->user_id;
        }
        $application->stage_id=$request->stage_id;
        $application->description=$request->description;
        $application->type_client_id=$request->type_client_id;
        $application->client_id=$request->client_id;
        $application->save();
        if($request->comment!=null){
                $comment=new Comment();
                $comment->comment_content=$request->comment;
                $comment->application_id=$application->id;
                $comment->save();
            }
        if($request->hasFile('files')){
            $files=$request->file('files');
            $destinationPath=public_path().Storage::url('/applications/').$application->id.'/';
            foreach ($files as $file){
                $image=new FilesApplication();
                $filename=$file->getClientOriginalName();
                $file->move($destinationPath,$filename);
                $image->file_path=$filename;
                $image->application_id=$application->id;
                $image->save();
            }
        }
        return redirect(route('applications.index'));
      //  return dd($application);
        //($application->id).'_'
    }
    public  function destroy($id){
        $application=Application::find($id);
        $application->delete();
        return redirect(route('applications.index'));
    }
}
