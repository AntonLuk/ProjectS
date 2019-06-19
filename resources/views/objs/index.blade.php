@extends('layouts.master')
@section('content')

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
<link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@18.11.1/dist/css/suggestions.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@18.11.1/dist/js/jquery.suggestions.min.js"></script>
    <form method="post" action="{{route('objs.search')}}">
        @csrf
        <input type="hidden" name="city" class="form-control" readonly id="md-city">
        <input type="hidden" name="street" class="form-control" readonly id="md-street">
        <input type="hidden" name="house" class="form-control" readonly id="md-house">
        <b class="spoiler-title form-control btn btn-secondary">Поиск</b>
        <div class="container-fluid bg-light spoiler-body">
            <div class="row">
                <div class="col-md-4 pt-3">
                    <div class="form-group ">
                        <label>Адрес</label>
                        <input id="address" class="form-control" name="address" type="text" />
                    </div>
                </div>

                <div class="col-md-2 pt-3">
                    <div class="form-group">
                        <label>Сотрудник</label>
                        <select id="inputState" name="user_id" class="form-control">
                            <option value=""></option>
                            @foreach($searchForm['users'] as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2 pt-3">
                    <div class="form-group">
                        <label>Район</label>
                        <select id="inputState" name="district" class="form-control">
                            <option value=""></option>
                            @foreach($searchForm['districts'] as $district)
                                <option value="{{$district->id}}">{{$district->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2 pt-3">
                    <div class="form-group">
                        <label>Ремонт</label>
                        <select id="inputState" name="repair_id" class="form-control">
                            <option value=""></option>
                        @foreach($searchForm['type_repairs'] as $rep)
                            <option value="{{$rep->id}}">{{$rep->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 pt-3">
                    <div class="form-group">
                        <label>Кол-во комнат</label>
                        <input type="number" min="1" class="form-control">
                    </div>
                </div>

                <div class="col-md-6 pt-3">
                    <div class="row">
                        <label>Год постройки</label>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="number" min="1" name="year" class="form-control">
                            </div>
                        </div>
                       <div class="col-md-2">
                           <div class="form-group">
                               <input type="number" min="1" name="year" class="form-control">
                           </div>
                       </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-2"><button type="submit" class="btn btn-primary btn-block">Поиск</button></div>
            </div>
        </div>
    </form>

<h2>Все объекты</h2>

<div class="table-responsive">
    <table class="table table-striped table-sm">
    <thead>
    @if(count($objs)==0)
        <div class="">
            <th class=""><h4>Нет объектов</h4></th>
            <th><a href="{{route('objs.addForm')}}" class="btn btn-success">Добавить объект</a> </th>
        </div>

    @else
        <tr>
            <th>ID</th>
            <th> Фото</th>
            <th>Адрес</th>
            <th>Этаж/Этажность</th>
            <th>Стоимость</th>
            @if(Entrust::hasRole('administrator'))
                <th>Сотрудник</th>
                @endif

            <th></th>
        </tr>
    @endif
        </thead>
        <tbody>

        @foreach($objs as $obj)
        <tr>
            <td>{{$obj->id}}</td>
            <td class="">
                <div data-allowfullscreen="true" data-width="200" data-maxwidth="300" id="fotorama{{$obj->id}}">
                    @foreach($obj->images as $image)
                        <img src="{{asset('storage/images/objs/'.$obj->id.'/'.$image->image_path)}}">

                        @endforeach
                </div>
                <script type="text/javascript">
                    $(function() {
                        $('#fotorama{{$obj->id}}').fotorama();
                        // document.getElementById('foto').style.width="300px";
                        // document.getElementById('thFoto').style.width="300px";
                    });
                </script>
            </td>
            {{--<td>{{asset('storage/images/objs/'.$obj->id)}}</td>--}}
            <td>г.{{$obj->city}},ул.{{$obj->street}}, {{$obj->house}}</td>
            <td>{{$obj->floor}}/{{$obj->floors}}</td>
            <td>{{$obj->price}}</td>
            @if(Entrust::hasRole('administrator'))
                <td>{{$obj->application->user->name}}</td>
            @endif
            <td>	<input type="button" class="btn btn-success"
                           value="Создать сделку"
                           onclick='
                                   location.href = "{{route('deals.addFormWithObj',['id'=>$obj->id])}}";'>
            </td>
            <td>	<input type="button" class="btn btn-info"
                           value="Показать"
                           onclick='
                                   location.href = "{{route('objs.show',['id'=>$obj->id])}}";'>
            </td>
            <td>	<input type="button" class="btn btn-danger"
                           value="Удалить"
                           onclick='if(confirm("Вы действительно хотите удалить объект?")) {
                                           location.href = "{{route('objs.destroy',['id'=>$obj->id])}}";}'>
            </td>
        </tr>
        @endforeach

        </tbody>

    </table>
    {{$objs->links()}}
</div>

<script>
    $("#address").suggestions({
        token: "76f21ccf3ffdbbd62a351a04db7fd236c29a4c4e",
        type: "ADDRESS",
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function(suggestion) {
            console.log(suggestion);
            document.getElementById('md-street').value = suggestion.data.street;
            // document.getElementById('md-flat').value = suggestion.data.flat;
            document.getElementById('md-city').value = suggestion.data.city;
            console.log(suggestion);
            if(suggestion.data.block_type==null){
                document.getElementById('md-house').value = suggestion.data.house;
            }
            if(suggestion.data.block_type!=null){
                document.getElementById('md-house').value = suggestion.data.house+suggestion.data.block_type+suggestion.data.block;
            }
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.spoiler-body').hide();
        $('.spoiler-title').click(function(){
            $(this).next().toggle();
            $('.spoiler-title').hide();});

    });
</script>
@endsection
