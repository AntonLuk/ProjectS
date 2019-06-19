@extends('layouts.master')
@section('content')
    <h2>{{$complex->name}}</h2>
    <form method="post" enctype="multipart/form-data" action="{{route('constructs.ComEdit')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{$complex->id}}">
        <div class="form-group">
            <label for="name">Наименование комплекса</label>
            <input type="text" required class="form-control" name="name"  value="{{$complex->name}}">
        </div>
        <h4>Вознаграждения</h4>
        @if(count($complex->rewards)!=0)
        @foreach($complex->rewards as $reward)
            <div class="form-group">
                <label for="">{{$reward->room->name}}</label>
                <input type="number" class="form-control" name="{{$reward->room->id}}" min="1" required placeholder="Введите процент вознаграждения для {{$reward->room->name}}" value="{{$reward->percent*100}}">
            </div>
        @endforeach
            @else
            @foreach($rooms as $room)
                <div class="form-group">
                    <label for="">{{$room->name}}</label>
                    <input type="number" class="form-control" name="{{$room->id}}" min="1" required placeholder="Введите процент вознаграждения для {{$room->name}}" value="">
                </div>
            @endforeach
@endif

        {{--<div class="form-group">--}}
        {{--<label for="department">Тип клиента</label>--}}
        {{--<select class="form-control" name="type_client_id">--}}
        {{--@foreach($type_clients as $type_client)--}}
        {{--<option value={{$type_client->id}}>{{$type_client->name}}</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
        {{--<label for="comments">Описание(Потребности)</label>--}}
        {{--<textarea style="width: 100%;--}}
        {{--box-sizing: border-box;" name="description" placeholder="Введите комментарий"></textarea>--}}
        {{--</div>--}}

        <button type="submit" class="btn btn-primary">Редактировать комплекс</button>
    </form>
@endsection