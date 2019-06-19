@extends('layouts.master')
@section('content')


    <div class="r-sidebar" >
        <div class="r-sidebar-item" >
            <!-- Sidebar Image -->
            <div class="img" style="height:300px; position:relative;" >
                @if($user->image_path=='default_avatar.jpg')
                    <img src="{{Storage::url($user->image_path)}}" alt="" class="img-responsive" style="position:absolute;height:100%;">
                    @else
                <img src="{{Storage::url('/users/'.$user->id.'/'.$user->image_path)}}" alt="" class="img-responsive" style="position:absolute;height:100%;">
                    @endif
            </div>
            <!-- Name -->
            <div class="name">
                <h3>{{$user->name}}</h3>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- Detail -->
        <div class="r-detail">
            <table>
                <tbody>
                <tr>
                    <th>Рабочий телефон</th>
                    <td>{{$user->work_number}}</td>
                </tr>
                <tr>
                    <th>Личный телефон</th>
                    <td>{{$user->personal_number}}</td>
                </tr>
                <tr>
                    <th>Отдел</th>
                    @foreach($user->departments as $department)
                        <td>{{$department->display_name}}</td>
                    @endforeach

                </tr>
                <tr>
                    <th>Роль</th>
                    @foreach($user->roles as $role)
                    <td>{{$role->display_name}}</td>
                        @endforeach
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$user->email}}</td>
                </tr>
                </tbody></table>

            <a href="{{route('users.show',['id'=>$user->id])}}">Редактировать</a>
        </div>
    </div>

@endsection