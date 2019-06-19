@extends('layouts.master')
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6/js/select2.min.js"></script>
    <div class="form-group">
        <label for="id_label_single">
            Выберите объект
        <select class="js-example-basic-single js-states form-control objs" id="id_label_single">
            @foreach($objs as $obj)
                <option value="{{$obj->id}}">ID:{{$obj->id}},Комн:{{$obj->room->name}},Адрес:{{$obj->city}},{{$obj->district->name}},{{$obj->street}},{{$obj->house}}</option>
            @endforeach
        </select>
        </label>
    </div>
    <div class="form-group">
        <label for="id_label_single">
            Выберите объект

        <select class="js-example-basic-single js-states form-control applications" id="id_label_single">
            @foreach($applications as $application)
                <option value="{{$application->id}}">ID:{{$application->id}},{{$application->client->name}}</option>
            @endforeach
        </select>
        </label>
    </div>
    {{--<div class="form-group">--}}
        {{--<div class="row">--}}
            {{--<div class="col">--}}

            {{--</div>--}}
        {{--</div>--}}


    {{--</div>--}}


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