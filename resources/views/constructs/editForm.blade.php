@extends('layouts.master')
@section('content')
    <h2> Застройщик {{$construct->name}}</h2>
    <form method="post" enctype="multipart/form-data" action="{{route('constructs.edit')}}">
        @csrf
        <input type="hidden" name="id" value="{{$construct->id}}">
        <div class="form-group">
            <label for="name">Наименование</label>
            <input type="text" required class="form-control" name="name" value="{{$construct->name}}">
        </div>
        <button type="submit" class="btn btn-primary">Изменить застройщика</button>
    </form>
        <h4>Комплексы</h4>
        <div class="table-responsive">
            <table class="table ">
                <thead class="thead-dark">
                <tr>
                    <th>Наименование</th>
                    <th>Комнаты</th>
                    <th>% комиссии</th>
                </tr>
                </thead>
                <tbody>

                @foreach($construct->complexs as $complex)
                    <tr class="table-primary">
                       <td>{{$complex->name}}</td>
                        <td><input type="button" class="btn btn-danger" value="Редактировать" onclick='location.href = "{{route('constructs.ComRewardsForm',['id'=>$complex->id])}}";'>
                        <td><input type="button" class="btn btn-danger" value="Удалить" onclick='location.href = "{{route('constructs.ComDestroy',['id'=>$complex->id])}}";'>
                    </tr>
                        @foreach($complex->rewards as $reward)
                            <tr>
                                <td></td>
                                <td>{{$reward->room->name}}</td>
                                <td>{{$reward->percent*100}}</td>
                            </tr>
                            @endforeach

                        {{--<td><input type="button" class="btn btn-danger" value="Удалить" onclick='location.href = "{{route('constructs.destroy',['id'=>$construct->id])}}";'>--}}
                        {{--</td>--}}

                        {{--<td>	<input type="button" class="btn btn-info"--}}
                        {{--value="Показать"--}}
                        {{--onclick='location.href = "{{route('clients.show',['id'=>$construct->id])}}";'>--}}
                        {{--</td>--}}
                        {{--<td>	<input type="button" class="btn btn-danger"--}}
                        {{--value="Удалить"--}}
                        {{--onclick='if(confirm("Вы действительно хотите удалить пользователя?")) {--}}
                        {{--location.href ="{{route('clients.destroy',['id'=>$construct->id])}}";}'>--}}
                        {{--</td>--}}

                @endforeach
                </tbody>
            </table>
        </div>
<a href="{{route('constructs.addComForm',['id'=>$construct->id])}}" class="btn btn-info">Добавить комплекс</a>


@endsection