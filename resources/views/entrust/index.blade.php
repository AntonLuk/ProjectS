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

                        <td>	<input type="button" class="btn btn-info"
                                       value="Показать"
                                       onclick='location.href = "{{route('entrust.show',['id'=>$role->id])}}";'>
                        </td>
                        {{--<td>	<input type="button" class="btn btn-danger"--}}
                                       {{--value="Удалить"--}}
                                       {{--onclick='if(confirm("Вы действительно хотите удалить ?")) {--}}
                                               {{--location.href ="{{route('entrust.destroy',['id'=>$role->id])}}";}'>--}}
                        {{--</td>--}}
                    </tr>
                 @endforeach
            </tbody>
        </table>
    </div>
        {{--<input type="submit" class="btn btn-success" value="Применить">--}}
    </form>
    @endsection
