@extends('layouts.master')
@section('content')
    <form method="post" action="{{route('entrust.applyset')}}">
        @csrf
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Роль</th>
            </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->display_name}}</td>
                        @foreach($permissions as $permission)
                        <td><input type="checkbox" @foreach($permission->roles as $role1)
                                    @if($role1->id==$role->id)
                                    checked
                                    @endif
                            @endforeach
                            name="{{$role->id}}[]" value="{{$permission->id}}">
                           {{$permission->display_name}}</td>
                        @endforeach
                        {{--<td>	<input type="button" class="btn btn-info"--}}
                                       {{--value="Показать"--}}
                                       {{--onclick='location.href = "{{route('clients.show',['id'=>$client->id])}}";'>--}}
                        {{--</td>--}}
                        {{--<td>	<input type="button" class="btn btn-danger"--}}
                                       {{--value="Удалить"--}}
                                       {{--onclick='if(confirm("Вы действительно хотите удалить пользователя?")) {--}}
                                               {{--location.href ="{{route('clients.destroy',['id'=>$client->id])}}";}'>--}}
                        {{--</td>--}}
                    </tr>
                 @endforeach
            </tbody>
        </table>
    </div>
        <input type="submit" class="btn btn-success" value="Применить">
    </form>
    @endsection
