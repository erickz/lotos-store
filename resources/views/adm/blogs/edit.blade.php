@extends('layouts.adm.adm')

@section('titlePage', 'Blogs - Edit')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left"><span class="fas fa-pencil"></span> Editar blog</h1>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="main-box">
                    <form method="post" role="form" action="{{ route('adm.blogs.update', [$blog->id]) }}">
                        @csrf
                        @method('patch')

                        <div class='row'>
                            <div class="form-group col-xs-12 {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label>Título</label>
                                <input type="text" name="title" class="form-control" placeholder="Título" value="{{ $blog->title }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('title') }}</span>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="form-group col-xs-12 {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label>Descrição</label>
                                <textarea name="description" class="form-control ckeditor" placeholder="Descrição">{{ $blog->description }}</textarea>
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('description') }}</span>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="form-group col-xs-12 {{ $errors->has('meta_title') ? 'has-error' : '' }}">
                                <label>Meta Título</label>
                                <input type="text" name="meta_title" class="form-control" placeholder="Meta Título" value="{{ $blog->meta_title }}">
                                <span class="help-block"><i class="icon-remove-sign"></i> {{ $errors->first('meta_title') }}</span>
                            </div>
                        </div>

                        <div class='row'>
                            <div class="form-group col-xs-12 {{ $errors->has('meta_description') ? 'has-error' : '' }}">
                                <label>Meta Descrição</label>
                                <textarea name="meta_description" class="form-control" placeholder="Meta Descrição">{{ $blog->meta_description }}</textarea>
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