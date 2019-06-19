@extends('layouts.master')
@section('content')
    <h3>Заявка №{{$application->id}}</h3>
    <form method="post" enctype="multipart/form-data" action="{{route('applications.edit')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="client_id" value="{{$application->client->id}}">
        <input type="hidden" name="id" value="{{$application->id}}">
        <div class="row">
            <div class="col ">
                <h4>Данные клиента</h4>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">ФИО</label>
                            <input class="form-control" readonly name="name" value="{{$application->client->name}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" readonly name="email" aria-describedby="emailHelp" placeholder="Введите email" value="{{$application->client->email}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="primary_number">Приоритетный номер</label>
                            <input class="form-control" readonly  name="primary_number" value="{{$application->client->primary_number}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="personal_number">Запасной номер</label>
                            <input class="form-control" readonly  name="secondary_number" value="{{$application->client->secondary_number}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <h4>Файлы прикрепленные к заявке</h4>
                <div class="table-responsive" style="width: 90%;
  overflow: auto;
  height: 300px;">
                    <table class="table table-striped table-sm" >
                        <thead>
                        <tr>
                            {{--<th>ID</th>--}}
                            <th>Наименование файла</th>
                            <th>Добавлен</th>
                            <th></th>
                            <th></th>

                        </tr>
                        </thead>
                        <tbody>
                            @if(count($application->files)!=0)
                                @foreach($application->files as $file)
                                    <tr>
                                        {{--<td>{{$file->id}}</td>--}}
                                        <td>{{$file->file_path}}</td>
                                        <td>{{$file->created_at}}</td>
                                        <td><input type="button" class="btn btn-success"
                                                  value="Cкачать"
                                                  onclick='{
                                                           location.href = "{{route('files.getAppFile',['AppId'=>$application->id,'FileId'=>$file->id])}}";}'></td>
                                        <td><input type="button" class="btn btn-danger"
                                                   value="Удалить"
                                                   onclick='if(confirm("Вы действительно хотите удалить файл?")) {
                                                           location.href = "{{route('files.deleteAppFile',['AppId'=>$application->id,'FileId'=>$file->id])}}";}'></td>
                                    </tr>
                                    @endforeach
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="form-group">
                <label>Прикрепить доп.файлы </label>
                <input type="file" name="files[]" multiple class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="department">Тип клиента</label>
                    <select class="form-control" name="type_client_id">
                        @foreach($type_clients as $type_client)
                            <option @if($application->type_client_id==$type_client->id) selected @endif value={{$type_client->id}}>{{$type_client->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Этап</label>
                    <select class="form-control" name="stage_id">
                        @foreach($stages as $stage)
                            <option @if($application->stage_id==$stage->id) selected @endif value={{$stage->id}}>{{$stage->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="comments">Описание(Потребности)</label>
            <textarea style="width: 100%;
        box-sizing: border-box;" name="description" placeholder="Введите описание"></textarea>
        </div>
        @if(count($application->comments)!=0)
        <div class="form-group">
        <label for="comments">Комментарии</label>
        @foreach($application->comments as $comment)
            <div class="form-group border border-info">
                <label for="comment">Комментарий № {{$comment->id}} Дата {{$comment->updated_at}}</label><br>
                <textarea readonly style="width: 100%;
        box-sizing: border-box; height: 100px" name="comment_show">{{$comment->comment_content}}</textarea>
            </div>

        @endforeach
        </div>
        @else
        <div class="form-group">
        <label for="comments">Нет комметариев</label>
        </div>
        @endif
        <div class="form-group">
            <b class="spoiler-title btn btn-secondary form-control">Добавить комментарий</b>
            <div class="spoiler-body">
                <div class="form-group">
                    <label for="comments">Новый комментарий</label>
                    <textarea style="width: 100%;
        box-sizing: border-box;" name="comment"></textarea>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.spoiler-body').hide();
                $('.spoiler-title').click(function(){
                    $(this).next().toggle()});
            });
        </script>
        <button type="submit" class="btn btn-primary">Редактировать заявку</button>
    </form>
    {{--<script>--}}
        {{--function BootstrapScrollTable(tbl) {--}}
            {{--$('tbody').css('overflow-y', 'scroll');--}}
            {{--$('tbody').css('position', 'absolute');--}}

            {{--var hTable = parseInt($('#' + tbl).css('height'));--}}
            {{--var hHead = parseInt($('#' + tbl + ' thead').css('height'));--}}
            {{--var h = hTable - hHead;--}}

            {{--$('#' + tbl + ' tbody').css('height', h);--}}


            {{--var thead = parseInt($('#' + tbl + ' thead').css('width'));--}}
            {{--var tbody = parseInt($('#' + tbl + ' tbody').css('width'));--}}
            {{--var delta = tbody - thead;--}}

            {{--$('tbody').css('width', $('thead').css('width'));--}}
            {{--var pos = $('tbody').position();--}}
            {{--var left = pos.left;--}}
            {{--var top = pos.top;--}}

            {{--$('tbody').css('left', left - 0);--}}
            {{--$('tbody').css('top', top - 0);--}}

            {{--var colCount = $('#' + tbl + ' thead tr:nth-child(1) th').length;--}}
            {{--var rowCount = $('#' + tbl + ' tbody tr').length;--}}

            {{--for (x = 1; x <= colCount; x++) {--}}
                {{--var w = parseInt($('#' + tbl + ' thead tr:nth-child(1) th:nth-child(' + x + ')').css('width'));--}}
                {{--if (x == colCount) {--}}
                    {{--w = w - 18;--}}
                {{--}--}}

                {{--for (y = 1; y <= rowCount; y++) {--}}
                    {{--var idx = '#' + tbl + ' tbody tr:nth-child(' + y + ') td:nth-child(' + x + ')';--}}
                    {{--$(idx).css('width', w);--}}
                {{--}--}}
            {{--}--}}
        {{--}--}}

        {{--$(document).ready(function() {--}}
            {{--BootstrapScrollTable('table1');--}}
        {{--});--}}

    {{--</script>--}}
@endsection
