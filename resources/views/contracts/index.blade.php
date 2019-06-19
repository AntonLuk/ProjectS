@extends('layouts.master')
@section('content')

    <h2>Все Договора</h2>
    @if(count($contracts)!=0)
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>ID</th>
                    {{--<th>Тип клиента</th>--}}
                    <th>Номер</th>
                    <th>Клиент</th>
                    {{--<th>Номер телефона(Запасной)</th>--}}
                    {{--<th>email</th>--}}
                    {{--<th>Привязанный сотрудник</th>--}}
                    <th>Заключен</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($contracts as $contract)
                        <tr>
                            <td><a href="">{{$contract->id}}</a> </td>
                            {{--<td>{{$client->type_client->name}}</td>--}}
                            <td>{{$contract->number}}</td>
                            <td><a href="{{route('clients.show',['id'=>$contract->client->id])}}">{{$contract->client->name}}</a></td>
                            {{--<td>{{$client->secondary_number}}</td>--}}
                            {{--<td>{{$client->email}}</td>--}}
                            {{--<td>{{$client->user->name}}</td>--}}
                            <td>{{$contract->created_at}}</td>
                            <td><a class="btn btn-info">Скачать</a></td>
                            {{--@foreach($user->departments as $department)--}}
                            {{--<td>{{$department->display_name}}</td>--}}
                            {{--@endforeach--}}
                            {{--@foreach($user->roles as $role)--}}
                            {{--<td>{{$role->display_name}}</td>--}}
                            {{--@endforeach--}}
                            {{--<td><a class="btn btn-info" href={{route('users.info',['id'=>$user->id])}}>Показать</a></td>--}}

                            {{--onclick='location.href = "clients/show/{{$client->id}}";'>--}}
                            {{--</td>--}}
                            {{--<td>	<input type="button" class="btn btn-success"--}}
                                           {{--value="Создать заявку"--}}
                                           {{--onclick='location.href = "{{route('applications.addFormWithClient',['client_id'=>$client->client->id])}}";'>--}}
                            {{--</td>--}}
                            {{--<td><a class="btn btn-info" href="{{route('clients.show',['id'=>$client->client->id])}}">Показать</a></td>--}}

                            {{--<td>	<a href="{{route('clients.destroy',['id'=>$client->id])}}" class="btn btn-danger">Удалить</a>--}}
                            {{--</td>--}}
                        </tr>
                    @endforeach


                </tbody>
            </table>
            {{$contracts->links()}}
        </div>
    @else
        <div class="text-center">
            <div class="container">
                <div class="form-group">
                    <h4>Нет договоров</h4>
                    {{--<a href="{{route('clients.addForm')}}" class="btn btn-success">Добавить клиента</a>--}}
                </div>
            </div>
        </div>
    @endif
@endsection