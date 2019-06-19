@extends('layouts.master')
@section('content')
<h2>Добавление комплекса к застройщику {{$construct->name}}</h2>
<form method="post" enctype="multipart/form-data" action="{{route('constructs.ComCreate')}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" value="{{$construct->id}}">
    <div class="form-group">
        <label for="name">Наименование комплекса</label>
        <input type="text" required class="form-control" name="name"  value="">
    </div>
    <h4>Вознаграждения</h4>
  @foreach($rooms as $room)
            <div class="form-group">
                <label for="">{{$room->name}}</label>
                <input type="number" class="form-control" name="{{$room->id}}" min="1" required placeholder="Введите процент вознаграждения для {{$room->name}}" value="">
            </div>
    @endforeach


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

    <button type="submit" class="btn btn-primary">Добавить комплекс</button>
</form>
@endsection