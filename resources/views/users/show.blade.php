@extends('layouts.master')
@section('content')

    <form method="post" enctype="multipart/form-data" action="{{route('users.update')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="form-group">
            <label for="password">Email address</label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{$user->email}}">
            {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="department">Отдел</label>
            <select class="form-control" @if(Entrust::hasRole('administrator')) @else disabled @endif name="department">
                @foreach($departments as $department)
                    <option value={{$department->id}}
                    @foreach($user->departments as $dep)
                            @if($department->id==$dep->id)
                                {{'selected'}}
                                @endif
                        @endforeach
                    >{{$department->name}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="role">Роль</label>
            <select class="form-control" @if(Entrust::hasRole('administrator')) @else disabled @endif name="role">
                @foreach($roles as $role)
                    <option value={{$role->id}}
                    @foreach($user->roles as $rol)
                        @if($role->id==$rol->id)
                            {{'selected'}}
                            @endif
                        @endforeach
                    >{{$role->display_name}}</option>
                @endforeach
            </select>
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
            <input class="form-control" name="name" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="work_number">Рабочий телефон</label>
            <input class="form-control" name="work_number" value="{{$user->work_number}}">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Фото</label>
            <input type="file" multiple class="form-control-file" name="image_path" aria-describedby="fileHelp">
        </div><br>
        <button type="submit" class="btn btn-primary">Редактировать пользователя</button>
    </form>
    @endsection