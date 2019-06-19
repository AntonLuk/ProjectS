<?php

namespace App\Http\Controllers;

use App\Application;
use App\Client;
use App\Contract;

use App\FilesApplication;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\Request;
use App\TypeClient;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Zizaco\Entrust;
use App\Stage;
class ClientsController extends Controller
{
    public function getAllClients(){
        if(Auth::user()->hasRole('administrator')){
            $clients = Client::paginate(10);//

        }
        else{
            $clients=Application::where('user_id',Auth::user()->id)->groupBy('client_id')->paginate(10);
            //$clients=$applications->client->groupBy('primary_number')->get();
            //Client::where('user_id',Auth::user()->id)->with(['comments','user','type_client'])->paginate(10);

        }
        //$clients = Client::with(['comments','user','type_client'])->get();//
        return($clients);
    }
    public function anyData(){
        $clients=$this->getAllClients();
        return view('clients.index',compact('clients'));
        //return (dd($clients));
    }
    public function getAllClientInfo($id){
        $client=Client::where('id', $id)->first();
        return($client);
    }
    public function show($id){
        $client=$this->getAllClientInfo($id);
//        $type_client=TypeClient::all();
//        $users=User::all();
        return view('clients.show',compact('client'));
        //return(dd($client));
    }
    public function addForm(){
      $type_clients=TypeClient::all();
//        $users=User::all();
        $stages=Stage::all();
        return view('clients.add',compact('type_clients','stages'));
    }
    public function create(Request $request){
            $client=new Client();
            $client->name=$request->name;
          //  $client->type_client_id=$request->type_client_id;
            $client->email=$request->email;
           // $client->description=$request->description;
            $client->primary_number=$request->primary_number;
            $client->secondary_number=$request->secondary_number;
          //  $client->user_id=Auth::user()->id;
            $client->save();
            $application=new Application();
            $application->description=$request->description;
            $application->user_id=Auth::user()->id;
            $application->type_client_id=$request->type_client_id;
            $application->client_id=$client->id;
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
            $contract=new Contract();
            $contract->number=round(microtime(true) * 1000);
            $contract->client_id=$client->id;
            $contract->save();
//            if($request->comment!=null){
//                $comment=new Comment();
//                $comment->comment_content=$request->comment;
//                $comment->client_id=$client->id;
//                $comment->save();
//            }
            return redirect(route('clients.data'));
       // return(Auth::user()->id);
    }
    public function destroy($id){
        $client=Client::find($id);
        $client->delete();
        return redirect(route('clients.data'));
    }
    public function update(Request $request){
//        //$client=new Client();
        $client=Client::where('id', $request->id)->first();
        $client->name=$request->name;
     //   $client->type_client_id=$request->type_client_id;
        $client->email=$request->email;
        //$client->description=$request->description;
        $client->primary_number=$request->primary_number;
        $client->secondary_number=$request->secondary_number;
       // $client->user_id=Auth::user()->id;
        $client->save();
//            if($request->comment!=null){
//                $comment=new Comment();
//                $comment->comment_content=$request->comment;
//                $comment->client_id=$client->id;
//                $comment->save();
//            }
        return redirect(route('clients.data'));
       // return (dd($client));
    }
}
