@extends('layouts.master')
@section('content')
    <form method="post" enctype="multipart/form-data" action="{{route('clients.update')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $client->id }}">
        <div class="form-group">
            <label for="password">Email address</label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{$client->email}}">
            {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
        </div>
        {{--<div class="form-group">--}}
            {{--<label for="type_client_id">Тип покупателя</label>--}}
            {{--<select class="form-control" name="type_client_id">--}}
                {{--@foreach($type_client as $type)--}}
                    {{--<option value={{$type->id}}--}}

                        {{--@if($type->id==$client->type_client->id)--}}
                            {{--{{'selected'}}--}}
                                {{--@endif--}}

                    {{-->{{$type->name}}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
        {{--@if(Entrust::hasRole('administrator')==true)--}}
            {{--<div class="form-group">--}}
                {{--<label for="user_id">Привязанный сотрудник</label>--}}
                {{--<select class="form-control" name="user_id">--}}
                    {{--@foreach($users as $user)--}}
                        {{--<option value={{$user->id}}--}}
                        {{--@if($user->id==$client->user->id)--}}
                            {{--{{'selected'}}--}}
                                {{--@endif--}}
                        {{-->{{$user->name}}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
            {{--@endif--}}

        <div class="form-group">

        </div>
        <div class="form-group">
            <label for="name">ФИО</label>
            <input class="form-control" name="name" value="{{$client->name}}">
        </div>
        <div class="form-group">
            <label for="work_number">Приоритетный телефон</label>
            <input class="form-control" name="primary_number" value="{{$client->primary_number}}">
        </div>
        <div class="form-group">
            <label for="work_number">Резервный номер</label>
            <input class="form-control" name="secondary_number" value="{{$client->secondary_number}}">
        </div>
        @if(count($client->applications))
            <div class="form-group">
                <label>Заявки</label>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Тип заявки</th>
                                <th>Этап</th>
                                <th>Сотрудник</th>
                                <th>Последнее изменение</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($client->applications as $application)
                                <tr>
                                    <td>{{$application->id}}</td>
                                    <td>{{$application->type_client->name}}</td>
                                    <td>{{$application->stage->name}}</td>
                                    <td>{{$application->user->name}}</td>
                                    <td>{{$application->updated_at}}</td>
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
            </div>
            @else
            @endif
        {{--@if(count($client->comments)!=0)--}}
        {{--<div class="form-group">--}}
            {{--<label for="comments">Комментарии</label>--}}
            {{--@foreach($client->comments as $comment)--}}
                {{--<br><label for="comment">Комментарий № {{$comment->id}} Дата {{$comment->updated_at}}</label><br>--}}
           {{--<textarea readonly style="width: 100%;--}}
{{--box-sizing: border-box; height: 100px" name="comment_show">{{$comment->comment_content}}</textarea>--}}
                {{--@endforeach--}}
        {{--</div>--}}
        {{--@else--}}
            {{--<div class="form-group">--}}
                {{--<label for="comments">Нет комметариев </label>--}}
            {{--</div>--}}
        {{--@endif--}}

        {{--<b class="spoiler-title btn btn-secondary">Добавить комментарий</b>--}}
        {{--<div class="spoiler-body">--}}
            {{--<div class="form-group">--}}
                {{--<label for="comments">Новый комментарий</label>--}}
                    {{--<textarea style="width: 100%;--}}
{{--box-sizing: border-box;" name="comment"></textarea>--}}
            {{--</div>--}}
        {{--</div>--}}
        <script type="text/javascript">
            $(document).ready(function(){
                $('.spoiler-body').hide();
                $('.spoiler-title').click(function(){
                    $(this).next().toggle()});
            });
        </script>
        <br>
        <br>
        {{--<div class="form-group">--}}
            {{--<label for="exampleInputFile">Фото</label>--}}
            {{--<input type="file" multiple class="form-control-file" name="image_path" aria-describedby="fileHelp">--}}
        {{--</div><br>--}}
        <button type="submit" class="btn btn-primary">Редактировать Клиента</button>
    </form>
    @endsection
