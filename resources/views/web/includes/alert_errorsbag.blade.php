<div class="alert {{ ! $errors->any() ? 'd-none' : '' }} alert-{{ session()->has('type') ? session()->get('type') : 'info' }}" role="alert">
    <div class="alert-text">
        <i class="fas {{ session()->has('icon') ? session()->get('icon') : 'fa-info-circle' }} text-white me-2 fa-sm"></i>{!! $errors ? $errors->first() : '' !!}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
</div>