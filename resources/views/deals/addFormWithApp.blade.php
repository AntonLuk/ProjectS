@extends('layouts.master')
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6/js/select2.min.js"></script>
    <form method="post" action="{{route('deals.createDeal')}}">
        @csrf
    <div class="form-group">
        <label for="id_label_single">
            Выберите объект
            <select class="js-example-basic-single js-states form-control objs" name="obj_id" onchange="profit()" id="id_label_single">
                <option></option>
                @foreach($objs as $obj)
                    <option value="{{$obj->id}}">ID:{{$obj->id}},Комн:{{$obj->room->name}},Адрес:{{$obj->city}},{{$obj->district->name}},{{$obj->street}},{{$obj->house}}</option>
                @endforeach
            </select>
        </label>
    </div>
    <div class="form-group">
        <label>
            Заявка
        </label>
            <input type="hidden" name="app_id"  value="{{$application->id}}">
            <input type="text"  class="form-control" value="ID:{{$application->id}},{{$application->client->name}}" readonly>
    </div>
    <div class="form-group">
        <label>Коммисия</label>
        <input type="number" class="form-control" id="rew" name="reward" min="0">
    </div>
       <div class="form-group d-none" id="obj_form">
           <div class="form-group">
               <label>Адрес</label>
               <input type="text" class="form-control" readonly id="address">
           </div>
           <div class="row">
               <div class="col">
                   <div class="form-group">
                       <label>ФИО владельца</label>
                       <input type="text" class="form-control" readonly id="client">
                   </div>
               </div>
           </div>
       </div>
        <input type="submit" class="btn btn-success">
    </form>
    <script>
        let objs=@json($objs);
        console.log(objs[0].images);
    </script>
    <script>
        function profit() {
            let complexs=@json($complexs);
            let objs=@json($objs);
            // let selobj=select.options[select.selectedIndex];
            let selobj=document.getElementById('id_label_single').value;
            for(let i=0;i<objs.length;i++){
                console.log(objs[i],selobj);
                if(selobj==objs[i].id){
                    if(objs[i].type_of_obj_id==2){
                        let rew=document.getElementById('rew');
                        let address=document.getElementById('address');
                        address.value=objs[i].address;
                        let obj_form=document.getElementById('obj_form');
                        obj_form.className='form-group';
                        let price=objs[i].price;
                        if(price<2000000){
                            rew.value=50000;
                        }
                        else{
                            rew.value=30000+price*0.02;
                        }
                        // alert('Новостройка');
                    }
                    else{

                    }
                }
            }

        }
    </script>

    <script>

        $(document).ready(function() {
            $(".objs").select2();
        });
        // $(document).ready(function() {
        //     $(".applications").select2();
        // });
        // $(".applications").select2();
        </script>

@endsection
