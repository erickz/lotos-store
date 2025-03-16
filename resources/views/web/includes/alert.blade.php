<div class="alert {{ session()->has('message') ? '' : 'd-none' }} alert-{{ session()->has('type') ? session()->get('type') : 'secondary' }}" role="alert">
    <div class="alert-text">
        <i class="fas {{ session()->has('icon') ? session()->get('icon') : 'fa-info-circle' }} text-primary me-2 fa-sm"></i>{!! session()->has('message') ? session()->get('message') : '' !!}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
</div>