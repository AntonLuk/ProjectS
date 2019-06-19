@extends('layouts.master')
@section('content')

<h2>Все сделки</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Объект(ID)</th>
                    <th>Заявка(ID)</th>
                    <th>Комиссия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deals as $deal)
                    <tr>
                        <td>{{$deal->id}}</td>
                        <td><a href="{{route('objs.show',['id'=>$deal->obj->id])}}" class="btn btn-info">{{$deal->obj->id}}</a></td>
                        <td><a href="{{route('applications.show',['id'=>$deal->application->id])}}" class="btn btn-info">{{$deal->application->id}}</a></td>
                        <td>{{$deal->profit}}руб.</td>
                        {{--<td>	<input type="button" class="btn btn-info"--}}
                                       {{--value="Показать"--}}
                                       {{--onclick='location.href = "{{route('entrust.show',['id'=>$role->id])}}";'>--}}
                        {{--</td>--}}
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
{{$deals->links()}}
        {{--<input type="submit" class="btn btn-success" value="Применить">--}}

@endsection
