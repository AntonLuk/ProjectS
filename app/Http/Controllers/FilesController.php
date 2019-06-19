<?php

namespace App\Http\Controllers;

use App\FilesApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
class FilesController extends Controller
{
     public function getAppFile($AppId,$FileId){
         $file=FilesApplication::find($FileId);
         return response()->download(public_path(Storage::url('applications/'.$AppId.'/'.$file->file_path)));
    }
    public function deleteAppFile($AppId,$FileId){
        //app(Illuminate\Filesystem\Filesystem::class)->delete(public_path('uploads/example.png'));
        $file=FilesApplication::find($FileId);

        unlink(public_path(Storage::url('applications/'.$AppId.'/'.$file->file_path)));
        $file->delete();
        return(redirect(route('applications.show',['id'=>$AppId])));
     }
     public function getContract($id){

     }
}
