@extends('layouts.master')
@section('content')
    <h2>Застройщики</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>ID</th>
                <th>Наименование</th>
            </tr>
            </thead>
            <tbody>
                @foreach($constructs as $construct)
                    <tr>
                        <td><a href="">{{$construct->id}}</a> </td>
                        <td>{{$construct->name}}</td>
                        <td>	<input type="button" class="btn btn-info"
                        value="Показать"
                        onclick='location.href = "{{route('constructs.editForm',['id'=>$construct->id])}}";'>
                        </td>
                        <td><input type="button" class="btn btn-danger" value="Удалить" onclick='location.href = "{{route('constructs.destroy',['id'=>$construct->id])}}";'>
                        </td>

                        {{--<td>	<input type="button" class="btn btn-info"--}}
                                       {{--value="Показать"--}}
                                       {{--onclick='location.href = "{{route('clients.show',['id'=>$construct->id])}}";'>--}}
                        {{--</td>--}}
                        {{--<td>	<input type="button" class="btn btn-danger"--}}
                                       {{--value="Удалить"--}}
                                       {{--onclick='if(confirm("Вы действительно хотите удалить пользователя?")) {--}}
                                               {{--location.href ="{{route('clients.destroy',['id'=>$construct->id])}}";}'>--}}
                        {{--</td>--}}
                    </tr>
    @endforeach
            </tbody>
        </table>
    </div>
    @endsection