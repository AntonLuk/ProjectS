@extends('layouts.master')
@section('content')
<h2>{{$role->display_name}}</h2>
<form method="post" enctype="multipart/form-data" action="{{route('entrust.edit')}}">
    @csrf
    <input type="hidden" name="id" value="{{$role->id}}">
    <div class="form-group">
        <label for="name">Наименование</label>
        <input type="text" required class="form-control" name="name" value="{{$role->display_name}}">
    </div>
    <h4>Права</h4>
    <div class="form-group">
        @foreach($permissions as $permission)
            <div class="custom-control custom-checkbox mb-3">
                {{--<input type="hidden" name="">--}}
                <input type="checkbox" class="custom-control-input" name="{{$permission->id}}" id="{{$permission->name}}"
                @foreach($role->permissions as $permission1)
                      @if($permission1->id==$permission->id)
                          checked
                          @endif
                    @endforeach>
                <label class="custom-control-label" for="{{$permission->name}}">{{$permission->display_name}}</label>
                {{--<div class="invalid-feedback">Example invalid feedback text</div>--}}
            </div>

        @endforeach
    </div>
    <button type="submit" class="btn btn-primary">Изменить роль</button>
</form>
@endsection