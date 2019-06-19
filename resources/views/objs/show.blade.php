@extends('layouts.master')
@section('content')
    <h2>Объект №{{$obj->id}}</h2>


    <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@18.11.1/dist/css/suggestions.min.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/suggestions-jquery@18.11.1/dist/js/jquery.suggestions.min.js"></script>
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>--}}

    {{--<!--[if lt IE 10]>--}}
    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js"></script>--}}
    {{--<![endif]-->--}}

    {{--<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->--}}
    {{--<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->--}}



    <form method="post" class="" enctype="multipart/form-data" action="{{route('objs.edit')}}">
        <div class="form-group">
            <label for="address">Введите адрес</label>
            <input id="address" name="address" class="form-control" type="text" size="100" value="{{$obj->address}}" />
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{$obj->id}}">
        <input type="hidden" id="geo_lat" name="geo_lat" value="{{$obj->geo_lat}}">
        <input type="hidden" id="geo_lon" name="geo_lon" value="{{$obj->geo_lon}}">
        {{--<input type="hidden" id="point" name="point" value="">--}}
        {{--<div class="form-row align-items-center">--}}
        @if(Auth::user()->id==$obj->user_id || Entrust::hasRole('administrator'))
        <p class="btn btn-success" value="" onclick="address()">Поменять адрес</p>
            @else <p class="btn btn-info">Объект привязан к сотруднику {{$obj->user->name}}({{$obj->user->work_number}})</p>
        @endif
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city">Город</label>
                        <input type="text" name="city" class="form-control" readonly id="md-city" value="{{$obj->city}}">
                    </div>
                    {{--<div class="form-group">--}}
                    {{--<label for="district">Район</label>--}}
                    {{--<input type="text" name="district" class="form-control" readonly id="md-district">--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label for="street">Улица</label>
                        <input type="text" name="street" class="form-control" readonly id="md-street" value="{{$obj->street}}">
                    </div>
                    <div class="form-group">
                        <label for="house">Дом</label>
                        <input type="text" name="house" class="form-control" readonly id="md-house" value="{{$obj->house}}">
                    </div>
                    <div class="form-group">
                        <label for="flat">Квартира</label>
                        <input type="text" name="flat" class="form-control" readonly id="md-flat" value="@if(Entrust::hasRole('administrator')==true || Auth::user()->id == $obj->user_id){{$obj->flat}}@endif">
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="map" style="height: 350px"></div>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="files">Фотографии</label>
                        <input type="file" id="files" name="image_path[]" class="form-control" multiple/>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Район</label>
                                <select name="district_id" class="form-control">
                                    @foreach($districts as $district)
                                        <option @if($district->id == $obj->district_id)selected @endif value={{$district->id}}>{{$district->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Год постройки</label>
                                <input type="number" class="form-control" value="{{$obj->years_construct}}" name="year_construct">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="type_obj_id">Тип объекта</label>
                                <select onchange="OnSelectionChange (this)" class="form-control" name="type_obj_id">
                                    <option value=""></option>
                                    @foreach($type_of_objs as $type)
                                        <option @if($type->id == $obj->type_of_obj_id)selected @endif value={{$type->id}}>{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row  d-none" id="new">
                        <div class="col">
                            <div class="form-group">
                                <label>Застройщик</label>
                                <select onchange="OnSelectionChangeConstr (this)" class="form-control" id="construct">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group d-none" id="complex" >
                                <label>Жилой комплекс</label>
                                <select name="complex_id" class="form-control" id="complexs">
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="type_material_id">Матерьял дома</label>
                                <select class="form-control" name="type_material_id">
                                    @foreach($type_materials as $material)
                                        <option @if($material->id == $obj->type_material_id)selected @endif value={{$material->id}}>{{$material->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="room">Количество комнат</label>

                                <select name="room" class="form-control">
                                    @foreach($rooms as $room)
                                        <option @if($obj->room->id==$room->id) selected @endif value="{{$room->id}}">{{$room->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="area">Площадь квартиры</label>
                                <input type="number" name="area" class="form-control" value="{{$obj->area}}" placeholder="м.кв">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="repair_id">Тип ремонта</label>
                            <select class="form-control" name="repair_id">
                                @foreach($type_repairs as $repair)
                                    <option @if($repair->id == $obj->repair_id)selected @endif value={{$repair->id}}>{{$repair->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label>Сан.Узен</label>
                            <select name="san_node_id" class="form-control">
                                @foreach($san_nodes as $node)
                                    <option @if($node->id == $obj->san_node_id)selected @endif value={{$node->id}}>{{$node->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="floor">Этаж</label>
                                <input type="number" name="floor" value="{{$obj->floor}}" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="area">Этажность</label>
                                <input type="number" name="floors" value="{{$obj->floors}}" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" for="price">Цена</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Р</div>
                            </div>
                            <input type="number" name="price" class="form-control" id="" value="{{$obj->price}}" placeholder="Цена">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="foto" data-allowfullscreen="true">
                        @foreach($obj->images as $image)
                            <img src="{{asset('storage/images/objs/'.$obj->id.'/'.$image->image_path)}}">
                        @endforeach
                    </div>

                    <script type="text/javascript">
                        $(function() {
                            $('#foto').fotorama();
                            // document.getElementById('foto').style.width="300px";
                            // document.getElementById('thFoto').style.width="300px";
                        });
                    </script>
                    {{--<div class="fotorama" id="foto" data-auto="false">--}}
                    {{--<img src="http://s.fotorama.io/1.jpg">--}}
                    {{--<img src="http://s.fotorama.io/2.jpg">--}}
                    {{--</div>--}}
                </div>

            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" name="description" rows="3">{{$obj->description}}</textarea>
            </div>
        </div>
        @if(Auth::user()->id==$obj->user_id || Entrust::hasRole('administrator'))
        <div class="form-group">
            <h4>Контакты</h4>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Выберите клиента</label>
                        <select class="form-control" name="application_id">
                            @foreach($applications as $application)
                                <option @if($application->id == $obj->application_id)selected @endif value={{$application->id}}>{{$application->client->name}} ({{$application->client->primary_number}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Номер владельца(доп)</label>
                        <input type="number" class="form-control" value="{{$obj->number_client}}" name="number_client">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        @if(Entrust::hasRole('administrator'))
                            <label>Выберите пользователя к которому будет прикреплен объект</label>
                            <select class="form-control" name="user_id">
                                @foreach($users as $user)
                                <option @if($obj->user_id==$user->id)
                                        selected
                                        @endif
                                        value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                            </select>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Редактировать объект</button>
            @endif
    </form>
    <script>
        function address() {
            document.getElementById('address').readOnly=false;
        }
    </script>
    <script type="text/javascript">
        function OnSelectionChange (select) {
            var selectedOption = select.options[select.selectedIndex];
            if (selectedOption.value=="1"){
                let div=document.getElementById('new');
                div.className='row';
                let constructs=@json($constructs);
                let select=document.getElementById('construct');
                console.log(select);
                select.options[0]=new Option("","");
                var i;
                for(i=0;i<constructs.length;++i){
                    // select.options[i].text = constructs[i].name;
                    // select.options[i].value = constructs[i].id;
                    select.options[i+1] = new Option(constructs[i].name, constructs[i].id);
                    console.log(constructs[i].name);
                }
            }
        }
    </script>
    <script type="text/javascript">
        function OnSelectionChangeConstr (select) {
            let div=document.getElementById('complex');
            let selcom=document.getElementById('complexs');
            let selconstruct = document.getElementById("construct");
            let construct = selconstruct.options[selconstruct.selectedIndex].value;
            div.className='form-group';
            let complexs=@json($complexs);
            let i;

            for(i=0;i<complexs.length;++i){
                if(complexs[i].construct_id==construct){
                    selcom.options[i]=new Option(complexs[i].name,complexs[i].id);
                }
            }
            let admin = complexs.find(item =>item.id == construct);
            console.log(admin);
        }
    </script>
    <script>
        function showFile(e) {
            var files = e.target.files;
            for (var i = 0, f; f = files[i]; i++) {
                if (!f.type.match('image.*')) continue;
                var fr = new FileReader();
                var div=document.getElementById('foto');
                div.innerText = "";
                fr.onload = (function(theFile) {
                    return function(e) {
                        var myImg = document.createElement("img");
                        //myImg.className="fotorama__img";
                        myImg.src =e.target.result;
                        myImg.className="img-thumbnail col-md-3";
                        var a = document.querySelector("#foto");
                        if (a) a.appendChild(myImg);
                        // $('.fotorama').fotorama();
                        // $('.fotorama').fotorama({
                        //     data: [
                        //         {img:e.target.result}
                        //     ]
                        // });
                        // console.log(e.target.files);

                    };
                })(f);
                fr.readAsDataURL(f);
            }

        }
        document.getElementById('files').addEventListener('change', showFile, false);
    </script>

    {{--<script type="text/javascript">--}}
        {{--function OnSelectionChange (select) {--}}
            {{--var selectedOption = select.options[select.selectedIndex];--}}
            {{--if (selectedOption.value=="1"){--}}
                {{--let div=document.getElementById('new');--}}
                {{--div.className='row';--}}
                {{--let constructs=@json($constructs);--}}
                {{--let select=document.getElementById('construct');--}}
                {{--console.log(select);--}}
                {{--select.options[0]=new Option("","");--}}
                {{--var i;--}}
                {{--for(i=0;i<constructs.length;++i){--}}
                    {{--// select.options[i].text = constructs[i].name;--}}
                    {{--// select.options[i].value = constructs[i].id;--}}
                    {{--select.options[i+1] = new Option(constructs[i].name, constructs[i].id);--}}
                    {{--console.log(constructs[i].name);--}}
                {{--}--}}
            {{--}--}}
        {{--}--}}
    {{--</script>--}}
    {{--<script type="text/javascript">--}}
        {{--function OnSelectionChangeConstr (select) {--}}
            {{--let div=document.getElementById('complex');--}}
            {{--let selcom=document.getElementById('complexs');--}}
            {{--let selconstruct = document.getElementById("construct");--}}
            {{--let construct = selconstruct.options[selconstruct.selectedIndex].value;--}}
            {{--div.className='form-group';--}}
            {{--let complexs=@json($complexs);--}}
            {{--let i;--}}

            {{--for(i=0;i<complexs.length;++i){--}}
                {{--if(complexs[i].construct_id==construct){--}}
                    {{--selcom.options[i]=new Option(complexs[i].name,complexs[i].id);--}}
                {{--}--}}
            {{--}--}}
            {{--let admin = complexs.find(item =>item.id == construct);--}}
            {{--console.log(admin);--}}
        {{--}--}}
    {{--</script>--}}
    {{--<script>--}}
        {{--function showFile(e) {--}}
            {{--var files = e.target.files;--}}
            {{--for (var i = 0, f; f = files[i]; i++) {--}}
                {{--if (!f.type.match('image.*')) continue;--}}
                {{--var fr = new FileReader();--}}
                {{--var div=document.getElementById('foto');--}}
                {{--div.innerText = "";--}}
                {{--fr.onload = (function(theFile) {--}}
                    {{--return function(e) {--}}
                        {{--var myImg = document.createElement("img");--}}
                        {{--//myImg.className="fotorama__img";--}}
                        {{--myImg.src =e.target.result;--}}
                        {{--myImg.className="img-thumbnail col-md-3";--}}
                        {{--var a = document.querySelector("#foto");--}}
                        {{--if (a) a.appendChild(myImg);--}}
                        {{--// $('.fotorama').fotorama();--}}
                        {{--// $('.fotorama').fotorama({--}}
                        {{--//     data: [--}}
                        {{--//         {img:e.target.result}--}}
                        {{--//     ]--}}
                        {{--// });--}}
                        {{--// console.log(e.target.files);--}}

                    {{--};--}}
                {{--})(f);--}}
                {{--fr.readAsDataURL(f);--}}
            {{--}--}}

        {{--}--}}
        {{--document.getElementById('files').addEventListener('change', showFile, false);--}}
    {{--</script>--}}

    <script type="text/javascript">
        var div=document.getElementById("map");
        //div.innerText = "";
        var myMap;
        ymaps.ready(init); // Ожидание загрузки API с сервера Яндекса
        var geo_lat=@json($obj->geo_lat);
        var geo_lon=@json($obj->geo_lon);
        function init () {
            myMap = new ymaps.Map("map", {
                center: [geo_lat,geo_lon], // Координаты центра карты
                zoom: 15 // Zoom
            });
            myGeoObject = new ymaps.GeoObject({
                // Описание геометрии.
                geometry: {
                    type: "Point",
                    coordinates: [geo_lat,geo_lon]
                },
                // Свойства.
                properties: {
                    // Контент метки.
                }
            });
            myMap.geoObjects.add(myGeoObject);
        }
        document.getElementById('address').readOnly=true;
        $("#address").suggestions({
            token: "76f21ccf3ffdbbd62a351a04db7fd236c29a4c4e",
            type: "ADDRESS",
            count: 5,
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            onSelect: function(suggestion) {
                //console.log(suggestion.data.street);
                //$('#md-street').text(suggestion.data.street);	/* Выводим название улицы */
                document.getElementById('md-street').value = suggestion.data.street;
                //document.getElementById('md-house').value = suggestion.data.house+suggestion.data.block_type+suggestion.data.block;
                document.getElementById('md-flat').value = suggestion.data.flat;
                document.getElementById('md-city').value = suggestion.data.city;
                //document.getElementById('md-district').value = suggestion.data.city_district;
                //   myMap.center([suggestion.data.geo_lat,suggestion.data.geo_lon]);
                // document.getElementById('md-area').value = suggestion.data.flat_area;
                //document.getElementById('md-house').value = suggestion.data.house+suggestion.data.block_type+suggestion.data.block;
                console.log(suggestion);
                if(suggestion.data.block_type==null){
                    document.getElementById('md-house').value = suggestion.data.house;
                }
                if(suggestion.data.block_type!=null){
                    document.getElementById('md-house').value = suggestion.data.house+suggestion.data.block_type+suggestion.data.block;
                }
                document.getElementById('geo_lat').value =suggestion.data.geo_lat;
                document.getElementById('geo_lon').value =suggestion.data.geo_lon;
                var div=document.getElementById("map");
                div.innerText = "";
                var myMap;
                ymaps.ready(init); // Ожидание загрузки API с сервера Яндекса
                function init () {
                    myMap = new ymaps.Map("map", {
                        center: [suggestion.data.geo_lat,suggestion.data.geo_lon], // Координаты центра карты
                        zoom: 15 // Zoom
                    });
                    myGeoObject = new ymaps.GeoObject({
                        // Описание геометрии.
                        geometry: {
                            type: "Point",
                            coordinates: [suggestion.data.geo_lat,suggestion.data.geo_lon]
                        },
                        // Свойства.
                        properties: {
                            // Контент метки.
                        }
                    });
                    myMap.geoObjects.add(myGeoObject);
                }
            }
        });
    </script>

@endsection
