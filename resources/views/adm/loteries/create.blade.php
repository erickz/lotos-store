@extends('layouts.adm.adm')

@section('titlePage', 'Loteries - Criar')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left"><span class="fas fa-receipt"></span> Add Lotery</h1>
            </div>

            <div class="row">
                <div class="main-box">
                    <form method="post" role="form" action="{{ route('adm.loteries.store') }}">
                        @csrf



                        <button type="submit" class="btn btn-lg btn-success">Save</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection