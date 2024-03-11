@if (session()->get('message'))
    <div class="alert alert-{{ session()->has('type') ? session()->get('type') : 'warning' }}">
        <i class="fas {{  session()->get('icon') }} fa-fw fa-lg"></i> {!! session()->get('message') !!}
    </div>
@endif