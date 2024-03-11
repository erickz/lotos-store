@extends('layouts.adm.adm')

@section('titlePage', 'Blogs - Create')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left"><span class="fas fa-plus-circle"></span> Add Blog</h1>
            </div>

            <div class="row">
                <div class="main-box">
                    <form method="post" role="form" action="{{ route('adm.blogs.store') }}">
                        @csrf

                        <div class="form-group">
                            <div class="onoffswitch newsletterSwitch onoffswitch-success">
                                <input type="checkbox" name="active" value="1" class="onoffswitch-checkbox" id="myonoffswitch4" checked="checked">
                                <label class="onoffswitch-label" for="myonoffswitch4">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="form-group col-xs-12 {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label>Título</label>
                                <input type="text" name="title" class="form-control" placeholder="Título" value="{{ old('title') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('title') }}</span>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="form-group col-xs-12 {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label>Descrição</label>
                                <textarea name="description" class="form-control ckeditor" placeholder="Descrição">{{ old('description') }}</textarea>
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('description') }}</span>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="form-group col-xs-12 {{ $errors->has('meta_title') ? 'has-error' : '' }}">
                                <label>Meta Título</label>
                                <input type="text" name="meta_title" class="form-control" placeholder="Meta Título" value="{{ old('meta_title') }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('meta_title') }}</span>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="form-group col-xs-12 {{ $errors->has('meta_description') ? 'has-error' : '' }}">
                                <label>Meta Descrição</label>
                                <textarea name="meta_description" class="form-control" placeholder="Meta Descrição"></textarea>
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('meta_description') }}</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-lg btn-success">Save</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection