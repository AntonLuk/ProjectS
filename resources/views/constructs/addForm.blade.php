@extends('layouts.master')
@section('content')
    <h2>Добавление клиента</h2>
    <form method="post" enctype="multipart/form-data" action="{{route('constructs.create')}}">
        @csrf
        <div class="form-group">
            <label for="name">Наименование</label>
            <input type="text" required class="form-control" name="name" value="" placeholder="Введите наименование">
        </div>


        <button type="submit" class="btn btn-primary">Создать застройщика</button>
    </form>
    @endsection