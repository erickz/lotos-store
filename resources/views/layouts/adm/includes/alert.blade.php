@if (session()->has('message'))
    <div class="alert alert-{{ session()->has('type') ? session()->get('type') : 'warning' }}">
        {!! session()->has('message') ? session()->get('message') : ''  !!}
    </div>
@endif