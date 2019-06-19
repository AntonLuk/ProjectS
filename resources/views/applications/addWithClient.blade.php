@extends('layouts.master')
@section('content')
    <h3>Создание заявки</h3>
    <form method="post" enctype="multipart/form-data" action="{{route('applications.create')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="client_id" value="{{$client->id}}">
        <div class="container border border-info">
            <h4>Данные клиента</h4>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">ФИО</label>
                        <input class="form-control" readonly name="name" value="{{$client->name}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" readonly name="email" aria-describedby="emailHelp" placeholder="Введите email" value="{{$client->email}}">
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="primary_number">Приоритетный номер</label>
                            <input class="form-control" readonly  name="primary_number" value="{{$client->primary_number}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="personal_number">Запасной номер</label>
                            <input class="form-control" readonly  name="secondary_number" value="{{$client->secondary_number}}">
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Прикрепить файлы</label>
                <input type="file" class="form-control" multiple name="files[]">
            </div>
        </div>
        <br>
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


        <div class="form-group">
            <label for="comments">Описание(Потребности)</label>
            <textarea style="width: 100%;
        box-sizing: border-box;" name="description" placeholder="Введите описание"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Создать Заявку</button>
    </form>
@endsection
