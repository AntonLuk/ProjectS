<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deal;
use Illuminate\Support\Facades\Auth;
use App\User;
use PhpOffice\PhpWord\PhpWord;
use Carbon\Carbon;
use App\Room;
class ReportsController extends Controller
{
    public function dealsUsers(Request $request){
       $userName=Auth::user()->name;
        $date=Carbon::now();
            $start = $request->start;
            $end = $request->end;
            $users = User::with(['deals' => function ($query) use ($start,$end) {
                    $query->whereBetween('deals.created_at',[$start,$end]);
            }])->get();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $tpl = $phpWord->loadTemplate(public_path('usersDeals.docx'));
        $tpl->setValue('user',$userName);
        $tpl->setValue('date',$date);
        $tpl->setValue('date_start', $request->start);
        $tpl->setValue('date_end',$request->end);
        $i = 0;
        $total_count=0;
        $total_prof=0;
        $tpl->cloneRow('num', $users->count() + 1);
        foreach($users as $user)
        {
            $userprof=0;
            $i++;
            $tpl->setValue('num#'.$i, $i);
            $tpl->setValue('name#'.$i, $user->name);
                     $count=count($user->deals);
            $tpl->setValue('count#'.$i, $count);
           foreach ($user->deals as $deal){
               $userprof+=$deal->profit;
           }
            $tpl->setValue('userProf#'.$i, $userprof);
           $total_prof+=$userprof;
            $total_count += $count;
        }
        $i++;
        $tpl->setValue('num#'.$i,"");
        $tpl->setValue('name#'.$i, "Итого");
        $tpl->setValue('count#'.$i, $total_count);
        $tpl->setValue('userProf#'.$i, $total_prof);
        $tpl->saveAs(public_path('users.docx'));
        return response()->download(public_path('users.docx'));
    }
    public function dealsUsersForm(){
        return view('reports.dealsUsers');
    }
    public function dinamic(Request $request){
        $names = ['Янв.','Февр.','Март','Апр.','Май','Июн.','Июл.','Авг.','Сен.','Окт.','Нояб.','Декаб.'];
        $rooms=Room::all();
        $start=Carbon::now()->subMonths($request->per);
        $end=Carbon::now();
        $startstr=$start->format('Y-m-d');
        $endstr=$end->format('Y-m-d');
        $data=array();
        $userName=Auth::user()->name;
        $date=Carbon::now();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $tpl = $phpWord->loadTemplate(public_path('dinamic.docx'));
        $tpl->setValue('user',$userName);
        $tpl->setValue('date',$endstr);
        $tpl->setValue('date_start', $startstr);
        $tpl->setValue('date_end',$endstr);
        for($i=0;$i<=$request->per;$i++){
            if($start==$end){
                break;
            }
            else{
                //array_push($data[$start->month],Deal::whereMonth('created_at','=',$start)->sum('profit'));
                $data[$i]=[
                    'prof'=>Deal::whereMonth('created_at','=',$start)->sum('profit'),
                    'm'=>$names[$start->month-1]
                ];
//                foreach ($rooms as $room){
//                    // $data[$i]=[$room->id=>Deal::whereMonth('created_at','=',$start)->where('room_id',$room->id)->sum('profit')];
//                    // array_push($data[$i],[$room->name=>Deal::whereMonth('created_at',$start)->with(['obj' => function ($query) use ($room) {
//                    $data[$i]+=[$room->name=>Deal::with(['obj' => function ($query) use ($room) {
//                        $query->where('objs.room_id',0);
//                    }])->whereMonth('deals.created_at',$start)->get()
//                    ];
//                }
                $deals=Deal::whereMonth('created_at',$start)->get();
                if(count($deals)!=0){
                    foreach ($deals as $deal) {
                        //return dd($deal->obj()->first()->room_id);
                        foreach ($rooms as $room){
                            $roomprof=0;
                            if($deal->obj()->first()->room_id==$room->id){
                                $roomprof+=$deal->profit;
                                $data[$i]+=[$room->name=>$roomprof];
                            }else{
                                $data[$i]+=[$room->name=>0];
                            }
                        }
                    }
                }else{
                    foreach ($rooms as $room){
                        $data[$i]+=[$room->name=>0];
                    }
                }
                $start=$start->addMonth(1);
            }
        }
        $start = $request->start;
        $end = $request->end;
        $users = User::with(['deals' => function ($query) use ($start,$end) {
            $query->whereBetween('deals.created_at',[$start,$end]);
        }])->get();

        $i = 0;
        $total_count=0;
        $total_prof=0;
        $tpl->cloneRow('month', count($data) * 5 + 2);
        foreach($data as $dat)
        {
            $i++;
            $tpl->setValue('month#'.$i, $dat['m']);
            $tpl->setValue('room#'.$i, '');
            $tpl->setValue('count#'.$i, $dat['prof']);
            foreach ($rooms as $room){
                foreach($dat as $key => $value){
                   if($key==$room->name){
                       $i++;
                       $tpl->setValue('month#'.$i, '');
                       $tpl->setValue('room#'.$i, $key);
                       $tpl->setValue('count#'.$i, $value);
                   }
                }

            }
            $total_prof+=$dat['prof'];
        }
        $i++;
        $tpl->setValue('month#'.$i,"");
        $tpl->setValue('room#'.$i, "");
        $tpl->setValue('count#'.$i, '');
        $i++;
        $tpl->setValue('month#'.$i,"Итого");
        $tpl->setValue('room#'.$i, "");
        $tpl->setValue('count#'.$i, $total_prof);
        $tpl->saveAs(public_path('dinamic1.docx'));
        return response()->download(public_path('dinamic1.docx'));
        }
}
