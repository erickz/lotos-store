@if ($errors->has('email') || $errors->has('password') || $errors->has('authentication'))
    <div class="alert alert-warning">
        {!! $errors->has('email') ? $errors->first('email') . "<br />" : ''  !!}
        {!! $errors->has('password') ? $errors->first('password') . "<br />" : ''  !!}
        {!! $errors->has('authentication') ? $errors->first('authentication') : ''  !!}
    </div>
@endif