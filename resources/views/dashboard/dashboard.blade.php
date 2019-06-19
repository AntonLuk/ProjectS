@extends('layouts.master')
@section('content')
    <div class="form-group">

    </div>
    <div class="row mb-3">
        <div class="col-xl-3 col-sm-6 py-2">
            <div class="card bg-success text-white ">
                <div class="card-body bg-success">
                    <div class="rotate">
                        <i class="fa fa-user fa-4x"></i>
                            <a class="btn btn-success fa fa-plus fa-2x pull-right" href="{{route('clients.addForm')}}"></a>
                    </div>
                    <h6 class="text-uppercase">Клиентов</h6>
                    <h1 class="display-4">{{$clientsCount}}</h1>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 py-2">
            <div class="card text-white bg-danger ">
                <div class="card-body bg-danger">
                    <div class="rotate">
                        <i class="fa fa-list fa-4x"></i>
                        <h4 class="pull-right">Покупка: {{$applicationsCount['buy']}}</h4>
                        <br>
                        <h4 class="pull-right">Продажа: {{$applicationsCount['sold']}}</h4>
                    </div>
                    <h6 class="text-uppercase">Заявки</h6>
                    <h1 class="display-4">{{$applicationsCount['all']}}</h1>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 py-2">
            <div class="card text-white bg-info ">
                <div class="card-body bg-info">
                    <div class="rotate">
                        <i class="fa fa-home fa-4x"></i>
                        <a class="btn btn-info fa fa-plus fa-2x pull-right" href="{{route('objs.addForm')}}"></a>
                    </div>
                    <h6 class="text-uppercase">Объектов</h6>
                    <h1 class="display-4">{{count($objs)}}</h1>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 py-2">
            <div class="card text-white bg-warning ">
                <div class="card-body">
                    <div class="rotate">
                        <i class="fa fa-thumbs-o-up fa-4x"></i>
                    </div>
                    <h6 class="text-uppercase">Сделок</h6>
                    <h1 class="display-4">0</h1>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="row">--}}
        {{--<div class="container">--}}
            {{--<div class="card card-default card-body">--}}
                {{--<ul id="tabsJustified" class="nav nav-tabs nav-justified">--}}
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="" data-target="#tab1" data-toggle="tab">List</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link active" href="" data-target="#tab2" data-toggle="tab">Profile</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="" data-target="#tab3" data-toggle="tab">More</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<!--/tabs-->--}}
                {{--<br>--}}
                {{--<div id="tabsJustifiedContent" class="tab-content">--}}
                    {{--<div class="tab-pane" id="tab1">--}}
                        {{--<div class="list-group">--}}
                            {{--<a href="" class="list-group-item"><span class="float-right label label-success">51</span> Home Link</a>--}}
                            {{--<a href="" class="list-group-item"><span class="float-right label label-success">8</span> Link 2</a>--}}
                            {{--<a href="" class="list-group-item"><span class="float-right label label-success">23</span> Link 3</a>--}}
                            {{--<a href="" class="list-group-item text-muted">Link n..</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="tab-pane active" id="tab2">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-7">--}}
                                {{--<h4>Profile Section</h4>--}}
                                {{--<p>Imagine creating this simple user profile inside a tab card.</p>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-5"><img src="//placehold.it/170" class="float-right img-responsive img-rounded"></div>--}}
                        {{--</div>--}}
                        {{--<hr>--}}
                        {{--<a href="javascript:;" class="btn btn-info btn-block">Read More Profiles</a>--}}
                        {{--<div class="spacer5"></div>--}}
                    {{--</div>--}}
                    {{--<div class="tab-pane" id="tab3">--}}
                        {{--<div class="list-group">--}}
                            {{--<a href="" class="list-group-item"><span class="float-right label label-info label-pill">44</span> <code>.panel</code> is now <code>.card</code></a>--}}
                            {{--<a href="" class="list-group-item"><span class="float-right label label-info label-pill">8</span> <code>.nav-justified</code> is deprecated</a>--}}
                            {{--<a href="" class="list-group-item"><span class="float-right label label-info label-pill">23</span> <code>.badge</code> is now <code>.label-pill</code></a>--}}
                            {{--<a href="" class="list-group-item text-muted">Message n..</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!--/tabs content-->--}}
            {{--</div><!--/card-->--}}
        {{--</div>--}}
    {{--</div>--}}
    <hr>
    <h4>Объекты</h4>
    <div class="row">
        <div class="col-md-10">
            <div id="map" style="height: 350px"></div>
        </div>

        <div class="col-md-2">
            <div class="form-check">
                <input class="form-check-input room" type="checkbox" onchange="rooms()" value=0 name="room[]" id="0room">
                <label class="form-check-label" for="defaultCheck1">
                    Студия
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input room" type="checkbox" value=1 onchange="rooms()" name="room[]" id="1room">
                <label class="form-check-label" for="defaultCheck2">
                    1
                </label>
            </div>
        </div>
    </div>
    <hr>
    <div class="">
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Заявки за текущий месяц</label>
                    {!! $appChart->render() !!}
                </div>
                <div class="col-md-6">
                    <label>Объекты за текущий месяц</label>
                    {!! $objsChart->render() !!}
                </div>


            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Заявки групп в текущем месяце</label>
                    {!! $testChart->render() !!}
                </div>
            </div>
        </div>
    </div>
    <?

    $client_id = '7007572';
    $scope = 'offline,messages'
    ?>

    <a href="https://oauth.vk.com/authorize?client_id=<?=$client_id;?>&display=page&redirect_uri=https://oauth.vk.com/blank.html&scope=<?=$scope;?>&response_type=token&v=5.37">Push the button</a>
    <script>
        function rooms() {
            let checkboxes=document.getElementsByClassName('room');
            let checkboxesChecked = []; // можно в массиве их хранить, если нужно использовать
            for (let index = 0; index < checkboxes.length; index++) {
                if (checkboxes[index].checked) {
                    checkboxesChecked.push(checkboxes[index].value); // положим в массив выбранный
                    console.log(checkboxes[index].value); // делайте что нужно - это для наглядности
                }
            }
            //console.log(check);
        }
    </script>
<script>
    var div=document.getElementById("map");
    div.innerText = "";
    var myMap;
    ymaps.ready(init);
    function init() {
        let objs=@json($objs);
        console.log(objs);
        var myMap = new ymaps.Map("map", {
                center: [57.153033, 65.534328],
            controls: [],
                zoom: 10,

            }, {
                searchControlProvider: 'yandex#search'
            });
        myMap.controls.add('zoomControl');
        let room;
        clusterer = new ymaps.Clusterer({
            /**
             * Через кластеризатор можно указать только стили кластеров,
             * стили для меток нужно назначать каждой метке отдельно.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/option.presetStorage.xml
             */
            preset: 'islands#invertedVioletClusterIcons',
            /**
             * Ставим true, если хотим кластеризовать только точки с одинаковыми координатами.
             */
            groupByCoordinates: false,
            /**
             * Опции кластеров указываем в кластеризаторе с префиксом "cluster".
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ClusterPlacemark.xml
             */
            clusterDisableClickZoom: true,
            clusterHideIconOnBalloonOpen: false,
            geoObjectHideIconOnBalloonOpen: false
        }),
            /**
             * Функция возвращает объект, содержащий данные метки.
             * Поле данных clusterCaption будет отображено в списке геообъектов в балуне кластера.
             * Поле balloonContentBody - источник данных для контента балуна.
             * Оба поля поддерживают HTML-разметку.
             * Список полей данных, которые используют стандартные макеты содержимого иконки метки
             * и балуна геообъектов, можно посмотреть в документации.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
             */
            getPointData = function (obj) {
                if(obj.room.name=='студия'){
                             room=0;
                        }else{
                             room=obj.room.name;
                        }
                return {
                    iconContent:room,
                    balloonContentHeader: 'Объект №<strong>' + obj.id + '</strong>',

                    balloonContent: `<div class="" style="height:100px; position:relative;"><img src="storage/images/objs/${obj.id}/${obj.images[0].image_path}" alt="" class="img-responsive" style="position:absolute;height:100%;"></div><div class="form-group"><div class="form-control">${obj.address}</div><div class="form-control"><label>Цена:</label>${obj.price} руб.</div><br><a href="objs/show/${obj.id}" class="btn btn-info">Открыть</a>`,
                    clusterCaption: 'Объект <strong>' + obj.id + '  '+obj.room.name+'</strong>'

                };
            },
            /**
             * Функция возвращает объект, содержащий опции метки.
             * Все опции, которые поддерживают геообъекты, можно посмотреть в документации.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
             */
            getPointOptions = function () {
                return {
                    preset: 'islands#violetIcon'
                };
            },

            geoObjects = [];

        /**
         * Данные передаются вторым параметром в конструктор метки, опции - третьим.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Placemark.xml#constructor-summary
         */
        for(let i=0;i<objs.length;i++){
            let point=[objs[i].geo_lat,objs[i].geo_lon];
            console.log(point);
            geoObjects[i] = new ymaps.Placemark(point, getPointData(objs[i]), getPointOptions());
        }

        /**
         * Можно менять опции кластеризатора после создания.
         */
        clusterer.options.set({
            gridSize: 80,
            clusterDisableClickZoom: true
        });

        /**
         * В кластеризатор можно добавить javascript-массив меток (не геоколлекцию) или одну метку.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#add
         */
        clusterer.add(geoObjects);
        myMap.geoObjects.add(clusterer);

        /**
         * Спозиционируем карту так, чтобы на ней были видны все объекты.
         */

        // myMap.setBounds(clusterer.getBounds(), {
        //     checkZoomRange: true
        // });

        // myMap.geoObjects
        //     //.add(myGeoObject)
        //     // .add(myPieChart)
        //     for(let i=0;i<objs.length;i++){
        //     console.log(objs[i].images[0].image_path);
        //     if(objs[i].room.name=='студия'){
        //          room=0;
        //     }else{
        //          room=objs[i].room.name;
        //     }
        //        // let room =objs[i].room.name;
        //
        //         myMap.geoObjects.add(new ymaps.Placemark([objs[i].geo_lat,objs[i].geo_lon], {
        //             iconContent:room,
        //             balloonContent: `<div class="" style="height:100px; position:relative;"><img src="storage/images/objs/${objs[i].id}/${objs[i].images[0].image_path}" alt="" class="img-responsive" style="position:absolute;height:100%;"></div>${objs[i].address} <br>Цена: ${objs[i].price} <br> <a href="objs/show/${objs[i].id}" class="btn btn-info">Открыть</a>`
        //
        //                 // balloonContent: `<div class="" style="height:100px; position:relative;"><img src="storage/images/objs/${objs[i].id}/${objs[i].images[0].image_path}" alt="" class="img-responsive" style="position:absolute;height:100%;"></div>${objs[i].address} <br>Цена: ${objs[i].price} <br> <a href="objs/show/${objs[i].id}" class="btn btn-info">Открыть</a>`
        //         }, {
        //             preset: 'islands#icon',
        //             iconColor: '#735184'
        //         }))
        //     }

    }
</script>
<script>
    function redirect(id) {
        alert(id);
        alert('objs/show/{id}'.replace('{id}', id));
        //window.location = 'objs/show/{id}';
    }
</script>

    @endsection
