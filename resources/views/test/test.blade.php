@if(Entrust::can('client-create'))
    <a href="{{ route('dashboard')}}"
       class="list-group-item childlist">{{ __('Новый клиент') }}</a>
@endif