@extends('layouts.master')
@section('content')
    <h2>Добавление клиента</h2>
    <form method="post" enctype="multipart/form-data" action="{{route('clients.create')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="name">ФИО</label>
            <input type="text" required class="form-control" name="name" value="">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Введите email" value="">
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="primary_number">Приоритетный номер</label>
                    <input type="number" required class="form-control" name="primary_number" value="">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="personal_number">Запасной номер</label>
                    <input class="form-control" name="secondary_number" value="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="department">Тип клиента</label>
                    <select class="form-control" name="type_client_id">
                        @foreach($type_clients as $type_client)
                            <option value={{$type_client->id}}>{{$type_client->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Этап</label>
                    <select class="form-control" name="stage_id">
                        @foreach($stages as $stage)
                            <option value={{$stage->id}}>{{$stage->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="form-group">
                <label>Прикрепить файлы </label>
                <input type="file" name="files[]" multiple class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="comments">Описание(Потребности)</label>
            <textarea style="width: 100%;
        box-sizing: border-box;" name="description" placeholder="Введите описание"></textarea>
        </div>


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

        <button type="submit" class="btn btn-primary">Создать Клиента</button>
    </form>
    @endsection
