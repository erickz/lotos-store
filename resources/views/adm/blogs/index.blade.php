@extends('layouts.adm.adm')

@section('titlePage', 'Blogs - Index')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left">Blogs</h1>

                <div class="pull-right top-page-ui">
                    <a href="{{ route('adm.blogs.create') }}" class="btn btn-primary pull-right">
                        <i class="fas fa-plus-circle"></i> Add blog
                    </a>
                </div>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="col-lg-12">
                    @if($blogs->count() <= 0)
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle fa-fw fa-lg"></i> Não há blogs serem exibidos
                    </div>
                    @else
                    @include('adm.blogs.listing')
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection