@extends('layouts.master')
@section('content')

    <h2>Все клиенты</h2>
    @if(count($clients)!=0)
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>ID клиента</th>
                {{--<th>Тип клиента</th>--}}
                <th>ФИО</th>
                <th>Номер телефона(Приоритетный)</th>
                {{--<th>Номер телефона(Запасной)</th>--}}
                {{--<th>email</th>--}}
                {{--<th>Привязанный сотрудник</th>--}}
                <th>Создан</th>
            </tr>
            </thead>
            <tbody>

            @if(Entrust::hasRole('administrator'))
            @foreach($clients as $client)
                <tr>
                    <td><a href="{{route('clients.show',['id'=>$client->id])}}">{{$client->id}}</a> </td>
                    {{--<td>{{$client->type_client->name}}</td>--}}
                    <td>{{$client->name}}</td>
                    <td>{{$client->primary_number}}</td>
                    {{--<td>{{$client->secondary_number}}</td>--}}
                    {{--<td>{{$client->email}}</td>--}}
                    {{--<td>{{$client->user->name}}</td>--}}
                    <td>{{$client->created_at}}</td>

                    {{--@foreach($user->departments as $department)--}}
                        {{--<td>{{$department->display_name}}</td>--}}
                    {{--@endforeach--}}
                    {{--@foreach($user->roles as $role)--}}
                        {{--<td>{{$role->display_name}}</td>--}}
                    {{--@endforeach--}}
                    {{--<td><a href={{route('users.info',['id'=>$user->id])}}>Показать</a></td>--}}
                    {{--<td><a href="info/{{$user->id}}">Показать</a></td>--}}

                    <td>	<input type="button" class="btn btn-success" value="Создать заявку" onclick='location.href = "{{route('applications.addFormWithClient',['client_id'=>$client->id])}}";'>
                    </td>
                    <td>	<input type="button" class="btn btn-info"
                                   value="Показать"
                                   onclick='location.href = "{{route('clients.show',['id'=>$client->id])}}";'>
                    </td>
                    <td>	<input type="button" class="btn btn-danger"
                                   value="Удалить"
                                   onclick='if(confirm("Вы действительно хотите удалить пользователя?")) {
                                       location.href ="{{route('clients.destroy',['id'=>$client->id])}}";}'>
                    </td>
                </tr>
            @endforeach
                @else
                @foreach($clients as $client)
                <tr>
                    <td><a href="{{route('clients.show',['id'=>$client->client->id])}}">{{$client->id}}</a> </td>
                    {{--<td>{{$client->type_client->name}}</td>--}}
                    <td>{{$client->client->name}}</td>
                    <td>{{$client->client->primary_number}}</td>
                    {{--<td>{{$client->secondary_number}}</td>--}}
                    {{--<td>{{$client->email}}</td>--}}
                    {{--<td>{{$client->user->name}}</td>--}}
                    <td>{{$client->client->created_at}}</td>

                    {{--@foreach($user->departments as $department)--}}
                    {{--<td>{{$department->display_name}}</td>--}}
                    {{--@endforeach--}}
                    {{--@foreach($user->roles as $role)--}}
                    {{--<td>{{$role->display_name}}</td>--}}
                    {{--@endforeach--}}
                    {{--<td><a class="btn btn-info" href={{route('users.info',['id'=>$user->id])}}>Показать</a></td>--}}

                    {{--onclick='location.href = "clients/show/{{$client->id}}";'>--}}
                    {{--</td>--}}
                    <td>	<input type="button" class="btn btn-success"
                                   value="Создать заявку"
                                   onclick='location.href = "{{route('applications.addFormWithClient',['client_id'=>$client->client->id])}}";'>
                    </td>
                    <td><a class="btn btn-info" href="{{route('clients.show',['id'=>$client->client->id])}}">Показать</a></td>

                    <td>	<a href="{{route('clients.destroy',['id'=>$client->id])}}" class="btn btn-danger">Удалить</a>
                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>
        </table>
        {{$clients->links()}}
    </div>
    @else
    <div class="text-center">
        <div class="container">
            <div class="form-group">
                <h4>У вас нету клиентов(((</h4>
                <a href="{{route('clients.addForm')}}" class="btn btn-success">Добавить клиента</a>
            </div>
        </div>
    </div>
    @endif
@endsection
