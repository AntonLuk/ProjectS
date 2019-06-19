<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="http://bootstraptema.ru/snippets/menu/2017/vam.md.css" />
{{--<script src="http://bootstraptema.ru/plugins/jquery/jquery-1.11.3.min.js"></script>--}}
<script src="http://bootstraptema.ru/snippets/menu/2017/vam.md.js"></script>
        <div class="col-md-2 col-md-offset-4">
            <div id="jquery-accordion-menu" style="min-width: 100px;" class="jquery-accordion-menu black">
                <ul id="demo-list">
                    {{--<li class="active"><a href="#"><i class="fa fa-home"></i>Home </a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-glass"></i>Events </a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-file-image-o"></i>Gallery </a>--}}
                        {{--<span class="jquery-accordion-menu-label">12 </span>--}}
                    {{--</li>--}}
                    <li><a href="{{route('dashboard')}}"><i class="fa fa-pie-chart"></i>Dashboard</a>
                    <li><a href=""><i class="fa fa-users"></i>Клиенты</a>
                        <ul class="submenu">
                            <li><a href="{{route('clients.data')}}">Все клиенты</a></li>
                            @if(Entrust::can('client-create'))
                            <li><a href="{{route('clients.addForm')}}">Новый клиент</a></li>
                            @endif
                            {{--<li><a href="#">Design </a>--}}
                                {{--<ul class="submenu">--}}
                                    {{--<li><a href="#">Graphics </a></li>--}}
                                    {{--<li><a href="#">Vectors </a></li>--}}
                                    {{--<li><a href="#">Photoshop </a></li>--}}
                                    {{--<li><a href="#">Fonts </a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a href="#">Consulting </a></li>--}}
                        </ul>
                    </li>
                    <li><a href=""><i class="fa fa-arrow-circle-down"></i>Заявки</a>
                        <ul class="submenu">
                            <li><a href="{{route('applications.index')}}">Все заявки</a></li>
                        </ul>
                    </li>
                    <li><a href=""><i class="fa fa-user"></i>Сотрудники</a>
                        <ul class="submenu">
                            <li><a href="{{route('users.data')}}">Все сотрудники</a></li>
                            @if(Entrust::can('user-create'))
                                <li><a href="{{route('users.addForm')}}">Новый сотрудник</a></li>
                            @endif
                        </ul>
                    </li>
                    <li><a href=""><i class="fa fa-home"></i>Объекты</a>
                        <ul class="submenu">
                            <li><a href="{{route('objs.index')}}">Все объекты</a></li>
                            <li><a href="{{route('objs.addForm')}}">Новый объект</a></li>
                        </ul>
                    <li><a href=""><i class="fa fa-address-book-o"></i>Договора</a>
                        <ul class="submenu">
                            <li><a href="{{route('contracts.index')}}">Все договора</a></li>
                            {{--<li><a href="{{route('objs.addForm')}}">Новый объект</a></li>--}}
                        </ul>
                    <li><a href=""><i class="fa fa-thumbs-o-up"></i>Сделки</a>
                        <ul class="submenu">
                            <li><a href="{{route('deals.index')}}">Все сделки</a></li>
                            <li><a href="{{route('deals.addForm')}}">Новая сделка</a></li>
                        </ul>
                    @if(Entrust::hasRole('administrator'))
                    <li><a href=""><i class="fa fa-cog"></i>Настройки</a>
                        <ul class="submenu">
                            <li><a href="{{route('entrust.index')}}">Настройка прав доступа</a></li>

                        </ul>
                        <li>
                        <a href=""><i class="fa fa-house"></i>Застройщики</a>
                        <ul class="submenu">
                            <li><a href="{{route('constructs.index')}}">Все застройщики</a></li>
                            <li><a href="{{route('constructs.addForm')}}">Новый застройщик</a></li>
                        </ul>
                        </li>
                        <li>
                            <a href="{{route('report.dealsUsersForm')}}"><i class="fa fa-house"></i>Отчеты</a>
                            <ul class="submenu">
{{--                                <li><a href="{{route('report.dealsUsersForm')}}">По сделкам</a></li>--}}
                                {{--<li><a href="{{route('constructs.addForm')}}">Новый застройщик</a></li>--}}
                            </ul>

                        @endif
                </ul>

            </div>

        </div><!-- ./col-md-4 col-md-offset-4 -->



<script type="text/javascript">
    //обработчик
    jQuery(document).ready(function () {
        jQuery("#jquery-accordion-menu").jqueryAccordionMenu();

    });
    //активный класс
    $(function(){
        $("#demo-list li").click(function(){
            $("#demo-list li.active").removeClass("active")
            $(this).addClass("active");
        })
    })
</script>

<script type="text/javascript">
    //поисковая строка
    (function($) {
        $.expr[":"].Contains = function(a, i, m) {
            return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };
        function filterList(header, list) {
            var form = $("<form>").attr({
                "class":"filterform",
                action:"#"
            }), input = $("<input>").attr({
                "class":"filterinput",
                type:"text"
            });
            $(form).append(input).appendTo(header);
            $(input).change(function() {
                var filter = $(this).val();
                if (filter) {
                    $matches = $(list).find("a:Contains(" + filter + ")").parent();
                    $("li", list).not($matches).slideUp();
                    $matches.slideDown();
                } else {
                    $(list).find("li").slideDown();
                }
                return false;
            }).keyup(function() {
                $(this).change();
            });
        }
        $(function() {
            filterList($("#form"), $("#demo-list"));
        });
    })(jQuery);
</script>