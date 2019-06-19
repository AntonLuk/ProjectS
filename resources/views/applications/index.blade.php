@extends('layouts.master')
@section('content')
    <h2>Все заявки</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>ID</th>
                <th>ФИО Клиента</th>
                <th>Номер телефона</th>
                <th>Тип клиента</th>
                <th>Этап</th>
                <th>Сотрудник</th>
                <th>Дата создания</th>

            </tr>
            </thead>
            <tbody>
            @foreach($applications as $application)
                <tr>
                    <td>{{$application->id}}</td>
                    <td>{{$application->client->name}}</td>
                    <td>{{$application->client->primary_number}}</td>
                    <td>{{$application->type_client->name}}</td>
                    <td>{{$application->stage->name}}</td>
                    <td>{{$application->user->name}}</td>
                    <td>{{$application->client->created_at}}</td>
                    <td>	<input type="button" class="btn btn-success"
                                   value="Создать сделку"
                                   onclick='location.href = "{{route('deals.addFormWithApp',['id'=>$application->id])}}";'>
                    </td>
                    <td>	<input type="button" class="btn btn-success"
                                   value="Показать"
                                   onclick='location.href = "{{route('applications.show',['id'=>$application->id])}}";'>
                    </td>
                    @if(Entrust::hasRole('administrator') || Auth::user()->id==$application->user_id)
                        <td>	<input type="button" class="btn btn-danger"
                                       value="Удалить"
                                       onclick='if(confirm("Вы действительно хотите удалить пользователя?")) {
                                           location.href = "{{route('applications.destroy',['id'=>$application->id])}}";}'>
                        </td>
                    @endif
                    {{--<td><a href="info/{{$user->id}}">Показать</a></td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endsection
