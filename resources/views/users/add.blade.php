@extends('layouts.master')
@section('content')
{{--<style>--}}
    {{--input:invalid {--}}
        {{--background-color: red;--}}
    {{--}--}}
{{--</style>--}}
<h3>Создание пользователя</h3>
    <form method="post" class="container" enctype="multipart/form-data" action="{{route('users.create')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="password">Email</label>
                    <input type="email" required class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="">
                    {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" required class="form-control" name="password" placeholder="Password">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="department">Отдел</label>
                    <select class="form-control" name="department">
                        @foreach($departments as $department)
                            <option value={{$department->id}}>{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="role">Роль</label>
                    <select class="form-control" name="role">
                        @foreach($roles as $role)
                            <option value={{$role->id}}>{{$role->display_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


        {{--<div class="form-group">--}}
        {{--<label for="exampleSelect2">Example multiple select</label>--}}
        {{--<select multiple class="form-control" name="exampleSelect2">--}}
        {{--<option>1</option>--}}
        {{--<option>2</option>--}}
        {{--<option>3</option>--}}
        {{--<option>4</option>--}}
        {{--<option>5</option>--}}
        {{--</select>--}}
        {{--</div>--}}
        <div class="form-group">
            <label for="name">ФИО</label>
            <input type="text" required  class="form-control" name="name" value="">
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="work_number">Рабочий телефон</label>
                    <input class="form-control" required  name="work_number" value="">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="personal_number">Личный телефон</label>
                    <input class="form-control" name="personal_number" value="">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="image_path">Фото</label>
            <input type="file" class="form-control" name="image_path" aria-describedby="fileHelp">

        </div>

        <button type="submit" class="btn btn-primary">Создать пользователя</button>
    </form>
@endsection
