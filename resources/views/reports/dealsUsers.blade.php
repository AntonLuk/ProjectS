

    @extends('layouts.master')
@section('content')
<div class="container">
        <div class="form-group">
            <h2>Отчет по сотрудникам за период</h2>
            <form method="post" action="{{route('report.dealsUsers')}}">
                @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Начало</label>
                        <input type="date" name="start" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <label>Конец</label>
                    <input type="date" name="end" class="form-control">
                </div>
            </div>
                <input type="submit" class="btn btn-success" value="Печать">
            </form>
        </div>
    <hr>
      <div class="form-group">
            <h2>Отчет по динамике продаж</h2>
            <form method="post" action="{{route('report.dinamic')}}">
                @csrf
                <div class="row">
                    <div class="col">
                           <label>За последние кол-во месяцев</label>
                            <input type="number" class="form-control"placeholder="Введите кол-во месяцев" name="per">

                    </div>
                </div>
                <input type="submit" class="btn btn-success" value="Печать">
            </form>
        </div>
    <hr>
    <div class="form-group">
        <h2>Отчет по обработке заявок за период</h2>
        <form method="post" action="">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Начало</label>
                        <input type="date" name="start" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <label>Конец</label>
                    <input type="date" name="end" class="form-control">
                </div>
            </div>
            <input type="submit" class="btn btn-success" value="Печать">
        </form>
    </div>
</div>
@endsection
