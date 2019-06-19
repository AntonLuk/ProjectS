<?php

namespace App\Http\Controllers;

use App\Application;
use App\Client;
use App\Department;
use App\DepartmentUser;
use App\Obj;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\UsersController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust;
class PagesController extends Controller
{
    protected $users;
    public function __construct(UsersController $users)
    {
        $this->users=$users;
    }


    public function chartObjs(){
        $names = ['Янв.','Февр.','Март','Апр.','Май','Июн.','Июл.','Авг.','Сен.','Окт.','Нояб.','Декаб.'];
        $labels=[];
        $data=[];
        $days=Carbon::now()->startOfMonth()->diffInDays(Carbon::now());
        for ($i = 1; $i <= $days+1; $i++) {
            array_push($labels,$i.''.$names[Carbon::now()->month-1]);
            if(Auth::user()->hasRole('administrator')){
                array_push($data,Obj::whereDay('created_at', '=', $i)->whereMonth('created_at','=',Carbon::now()->month)->count());
            }else{
                array_push($data,Obj::whereDay('created_at', '=', $i)->whereMonth('created_at','=',Carbon::now()->month)->where('user_id',Auth::user()->id)->count());
            }

        }
        $chartjs = app()->chartjs
            ->name('lineObgs')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Объекты",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $data,
                ]
            ])
            ->optionsRaw("{
            scales: {
                        yAxes:[
                                {
                                    ticks:{
                                            callback:function(value) {if (value % 1 === 0) {return value;}}
                                          }
                                }
                             ]
                    }
               }");
        return($chartjs);
    }
    public function chartApplications(){
        $names = ['Янв.','Февр.','Март','Апр.','Май','Июн.','Июл.','Авг.','Сен.','Окт.','Нояб.','Декаб.'];

        $labels=[];
        $dataBuy=[];
        $dataSold=[];
        $days=Carbon::now()->startOfMonth()->diffInDays(Carbon::now());

        for ($i = 1; $i <= $days+1; $i++) {
            array_push($labels,$i.''.$names[Carbon::now()->month-1]);
            if(Auth::user()->hasRole('administrator')){
                array_push($dataBuy,Application::whereDay('created_at', '=', $i)->whereMonth('created_at','=',Carbon::now()->month)->where('type_client_id',1)->count());
                array_push($dataSold,Application::whereDay('created_at', '=', $i)->whereMonth('created_at','=',Carbon::now()->month)->where('type_client_id',2)->count());
            }else{
                array_push($dataBuy,Application::whereDay('created_at', '=', $i)->whereMonth('created_at','=',Carbon::now()->month)->where('user_id',Auth::user()->id)->where('type_client_id',1)->count());
            }

        }
        $chartjs = app()->chartjs
            ->name('lineApp')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Заявки на покупку",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $dataBuy,
                 ],
                [
                     'data'=>$dataSold,
                    'backgroundColor' =>"lightblue",
                    'label'=>'Заявки на продажу',
                    'borderColor' => "rgba(38, 185, 154, 0.7)",

                ]
            ])
            ->optionsRaw("{
            scales: {
                        yAxes:[
                                {
                                    ticks:{
                                            callback:function(value) {if (value % 1 === 0) {return value;}}
                                          }
                                }
                             ]
                    }
               }");
        return($chartjs);
    }
    public function chartGroupsApplications(){
        $names = ['Янв.','Февр.','Март','Апр.','Май','Июн.','Июл.','Авг.','Сен.','Окт.','Нояб.','Декаб.'];

        $labels=[];
        $data=[];
        $dataSold=[];
        $applications=Application::all();
        $deps=Department::all();
        $days=Carbon::now()->startOfMonth()->diffInDays(Carbon::now());
        foreach ($deps as $dep){
            array_push($labels,$dep->name);
            $depusers=DepartmentUser::where('department_id',$dep->id)->get();
            foreach ($depusers as $depuser){
                $count=Application::whereMonth('created_at',Carbon::now()->month)->where('user_id',$depuser->user_id)->count();
                //return dd($count);
                array_push($data,$count);
            }


        }
//        for ($i = 0; $i <= $dep; $i++) {
//            array_push($labels,$i.''.$names[Carbon::now()->month-1]);
//            if(Auth::user()->hasRole('administrator')){
//                array_push($dataBuy,Application::whereDay('created_at', '=', $i)->whereMonth('created_at','=',Carbon::now()->month)->where(Application::user()-> departments,2)->count());
//                array_push($dataSold,Application::whereDay('created_at', '=', $i)->whereMonth('created_at','=',Carbon::now()->month)->where('type_client_id',2)->count());
//            }else{
//                array_push($dataBuy,Application::whereDay('created_at', '=', $i)->whereMonth('created_at','=',Carbon::now()->month)->where('user_id',Auth::user()->id)->where('type_client_id',1)->count());
//            }
//
//        }
        $chartjs = app()->chartjs
            ->name('lineTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Заявки групп",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $data,
                ],
//                [
//                    'data'=>$dataSold,
//                    'backgroundColor' =>"lightblue",
//                    'label'=>'Заявки на продажу',
//                    'borderColor' => "rgba(38, 185, 154, 0.7)",
//
//                ]
            ])
            ->optionsRaw("{
            scales: {
                        yAxes:[
                                {
                                    ticks:{
                                            callback:function(value) {if (value % 1 === 0) {return value;}}
                                          }
                                }
                             ]
                    }
               }");
        return($chartjs);
    }
    public function dashboard()
    {
        if(Auth::user()->hasRole('administrator')){
        $objs=Obj::with(['room','images'])->get();

        }else{
            $objs=Obj::where('user_id',Auth::user()->id)->with(['room','images'])->get();
        }
        $applicationsCount = [];
        $applicationsCount['buy'] = Application::where('type_client_id',1)->count();
        $applicationsCount['sold'] = Application::where('type_client_id',2)->count();
        $applicationsCount['all']=Application::all()->count();
        //$objsCount=Obj::all()->count();
        if(Auth::user()->hasRole('administrator')){
        $clientsCount=Client::all()->count();
        }else{
            $clientsCount=Application::where('user_id',Auth::user()->id)->groupBy('client_id')->count();
        }
        $user=User::find(Auth::user()->id);
        $appChart=$this->chartApplications();
        $objsChart=$this->chartObjs();
        $testChart=$this->chartGroupsApplications();
        return view('dashboard.dashboard',compact('appChart','objsChart','user','applicationsCount','clientsCount','testChart','objs'));
        //return dd($days);

    }
}
