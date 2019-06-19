@extends('layouts.master')
@section('content')
    <h2>Все пользователи</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Фото</th>
                <th>ФИО</th>
                <th>Номер телефона(рабочий)</th>
                <th>email</th>
                <th>Отдел</th>
                <th>Роль</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td><div data-allowfullscreen="true" data-width="200" data-maxwidth="300" id="fotorama{{$user->id}}">
                        @if($user->image_path=='default_avatar.jpg')
                            <img src="/default_avatar.jpg">
                        @else
                            <img src="{{Storage::url('users/'.$user->id."/".$user->image_path)}}">
                        @endif
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            $('#fotorama{{$user->id}}').fotorama();
                        });
                    </script>
                </td>
                <td><a href={{route('users.show',['id'=>$user->id])}}>{{$user->name}}</a> </td>
                <td>{{$user->work_number}}</td>
                <td>{{$user->email}}</td>
                @foreach($user->departments as $department)
                <td>{{$department->name}}</td>
                    @endforeach
                @foreach($user->roles as $role)
                    <td>{{$role->display_name}}</td>
                @endforeach
                {{--<td><a href={{route('users.info',['id'=>$user->id])}}>Показать</a></td>--}}
                {{--<td><a href={{route('users.destroy',['id'=>$user->id])}}>Удалить</a></td>--}}
                <td>	<input type="button" class="btn btn-info"
                               value="Показать"
                               onclick='location.href = "{{route('users.info',['id'=>$user->id])}}";'>
                </td>
                @if(Entrust::hasRole('administrator'))
                <td>	@if($user->id!=1)
                        <input type="button" class="btn btn-danger"
                            value="Удалить"
                            onclick='if(confirm("Вы действительно хотите удалить пользователя?")) {
                                location.href = "{{route('users.destroy',['id'=>$user->id])}}";}'>
                            @endif
                </td>
                @endif
                {{--<td><a href="info/{{$user->id}}">Показать</a></td>--}}
            </tr>
                @endforeach

            </tbody>
        </table>
        {{$users->links()}}
    </div>
    @endsection
